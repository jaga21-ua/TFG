<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function handleChat(Request $request)
    {
        $symptoms = $request->input('symptoms');

        // Aquí es donde se integraría la lógica de procesamiento de síntomas
        // Puedes usar ChatGPT de OpenAI para esto, a continuación un ejemplo
        // del flujo de trabajo (esto debe hacerse de manera segura y con autorización)

        $response = $this->getDiagnosisAndRecommendations($symptoms);

        return response()->json(['response' => $response]);
    }

    private function getDiagnosisAndRecommendations($symptoms)
    {
        // Integrar aquí la lógica para obtener diagnóstico y recomendaciones
        // Puedes usar la API de OpenAI, aquí un ejemplo con curl (asegúrate de configurar correctamente tu API Key):

        $apiKey = 'tu-api-key-de-openai';
        $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';

        $data = [
            'prompt' => "El usuario reporta los siguientes síntomas: $symptoms. Proporcione un diagnóstico y recomendaciones.",
            'max_tokens' => 150
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\nAuthorization: Bearer $apiKey\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            return 'Lo siento, hubo un error al procesar su solicitud.';
        }

        $response = json_decode($result, true);
        return $response['choices'][0]['text'];
    }
}
