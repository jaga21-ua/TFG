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
    protected $questions = [
        'edad' => '¿Cuál es la edad del paciente?',
        'sexo' => '¿Cuál es el sexo del paciente?',
        'historial' => '¿Tiene el paciente algún historial médico relevante? (Por ejemplo: diabetes, hipertensión, enfermedades cardíacas, etc.)',
        'alergias' => '¿Tiene el paciente alguna alergia conocida?',
        'medicamentos' => '¿Está el paciente tomando algún medicamento actualmente? Si es así, ¿cuál?',
        'sintoma_principal' => '¿Cuál es el síntoma principal que presenta el paciente?',
        'duracion' => '¿Cuánto tiempo ha estado presente este síntoma?',
        'descripcion' => '¿Cómo describiría el paciente su síntoma? (Por ejemplo: dolor agudo, dolor sordo, picazón, etc.)',
        'ubicacion' => '¿Dónde se localiza el síntoma? (Por ejemplo: cabeza, abdomen, pecho, etc.)',
        'irradiacion' => '¿El dolor o síntoma se irradia a otras partes del cuerpo? Si es así, ¿a dónde?',
        'factores_desencadenantes' => '¿Hay algo que parezca desencadenar o empeorar el síntoma? (Por ejemplo: actividad física, comida, estrés, etc.)',
        'factores_alivio' => '¿Hay algo que parezca aliviar el síntoma? (Por ejemplo: descanso, medicamentos, posición del cuerpo, etc.)',
        'sintomas_adicionales' => '¿Hay otros síntomas presentes? (Por ejemplo: fiebre, náuseas, mareos, etc.)',
        'impacto' => '¿El síntoma afecta las actividades diarias del paciente? Si es así, ¿cómo?',
        'gravedad' => '¿Cómo calificaría el paciente la gravedad del síntoma en una escala del 1 al 10?',
        'consultas_anteriores' => '¿Ha consultado el paciente a algún profesional de la salud sobre este síntoma anteriormente? Si es así, ¿cuál fue el diagnóstico o recomendación?',
    ];

    public function handleChat(Request $request)
    {
        $currentQuestionIndex = $request->input('current_question_index', 0);
        $answers = $request->input('answers', []);
        
        // Save the answer for the current question
        if ($request->has('response')) {
            $answers[$currentQuestionIndex] = $request->input('response');
        }

        // Check if there are more questions
        if ($currentQuestionIndex < count($this->questions) - 1) {
            $currentQuestionIndex++;
            $question = array_values($this->questions)[$currentQuestionIndex];
            return response()->json([
                'question' => $question,
                'current_question_index' => $currentQuestionIndex,
                'answers' => $answers,
            ]);
        }

        // All questions answered, generate summary
        $summary = $this->generateSummary($answers);
        return response()->json([
            'summary' => $summary,
        ]);
    }

    protected function generateSummary($answers)
    {
        $keys = array_keys($this->questions);
        $summary = "";

        foreach ($keys as $index => $key) {
            $summary .="-" . $this->questions[$key] . " \n +" . ($answers[$index] ?? 'No respuesta') . "\n";
        }

        return $summary;
    }

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
                'fecha' => now(),
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
                        'content' => 'You are a doctor',
                    ],
                    [
                        'role' => 'user',
                        'content' => $request->symptoms . "Proporcione un diagnóstico breve y específico y recomiende un tratamiento o medicamento adecuado para los sintomas descritos en las respuestas de estas preguntas hechas. Sea conciso y directo.",
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
                'fecha' => now(),
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
