<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Diagnostico;
use App\Models\Mensaje;
use App\Models\User;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Verificar si se proporcionó una ID de diagnóstico
            if ($request->has('diagnostico_id') && !empty($request->diagnostico_id)) {
                $diagnostico = Diagnostico::find($request->diagnostico_id);

                // Verificar si el diagnóstico existe
                if (!$diagnostico) {
                    return response()->json(['error' => 'Diagnóstico no encontrado.'], 404);
                }
            } else {
                // Crear un nuevo diagnóstico si no se proporcionó una ID
                $diagnostico = Diagnostico::create([
                    'user_id' => Auth::id(),
                    'sintomas' => $request->symptoms,
                    'texto_diagnostico' => 'Diagnóstico generado automáticamente',
                    'gravedad' => 'leve',
                    'tratamiento' => null,
                ]);
            }

            // Crear un nuevo mensaje
            $mensaje = Mensaje::create([
                'diagnostico_id' => $diagnostico->id,
                'texto' => $request->symptoms,
                'es_persona' => true,
                'user_id' => Auth::id(),
            ]);

            // Llamada a la API de OpenAI para obtener una respuesta
            $apiKey = env('OPENAI_API_KEY');
            $response = Http::withHeaders([
                'Authorization' => "Bearer $apiKey",
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful assistant.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $request->symptoms,
                    ],
                ],
            ]);

            // Depuración de errores HTTP
            if ($response->failed()) {
                \Log::error('Error al obtener la respuesta de ChatGPT. Código de estado: ' . $response->status() . '. Respuesta: ' . $response->body());
                return response()->json(['error' => 'Error al obtener la respuesta de ChatGPT.'], 500);
            }

            // Depuración de la respuesta completa
            \Log::info('Respuesta de ChatGPT: ' . $response->body());

            // Procesar la respuesta de ChatGPT
            $chatGptResponse = $response->json();
            $botResponse = $chatGptResponse['choices'][0]['message']['content'] ?? 'No response from ChatGPT.';

            // Crear un nuevo mensaje de respuesta
            Mensaje::create([
                'diagnostico_id' => $diagnostico->id,
                'texto' => $botResponse,
                'es_persona' => false,
                'user_id' => null,
            ]);

            return response()->json(['response' => $botResponse]);

        } catch (\Exception $e) {
            // Registrar el error
            \Log::error('Error al almacenar el diagnóstico: ' . $e->getMessage());

            // Devolver una respuesta de error
            return response()->json(['error' => 'Ocurrió un error al procesar su solicitud.'], 500);
        }
    }

    public function index()
    {
        // Obtener todos los diagnósticos del usuario autenticado
        $diagnosticos = Diagnostico::where('user_id', Auth::id())->get();
        return view('chat', compact('diagnosticos'));
    }

    public function show($id)
    {
        // Obtener los mensajes del diagnóstico especificado
        $mensajes = Mensaje::where('diagnostico_id', $id)->get();
        return response()->json($mensajes);
    }
}
