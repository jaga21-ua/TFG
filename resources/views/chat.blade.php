@extends('welcome')

@section('content')
<div class="container text-black">
    <h1>Chat de Diagnóstico</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="list-group" style="background-color: #00C8F8" id="chat-list">
                @foreach($diagnosticos as $diagnostico)
                    <a href="#" class="list-group-item list-group-item-action" data-id="{{ $diagnostico->id }}" onclick="loadMessages({{ $diagnostico->id }})">
                        {{ $diagnostico->texto_diagnostico }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-8">
            <div class="chat-container" style="background-color:#88E6FF;width:90%;height: 535px;display: flex;flex-direction: column;border-radius: 30px">
                <div id="chat-box" class="chat-box" style="flex: 1; overflow-y: auto; padding: 10px;"></div>
                <div class="input-group mb-3" style="margin-top: auto; width: 90%; margin-left: auto; margin-right: auto;">
                    <input type="text" id="user-input" class="form-control" placeholder="Describe tus síntomas..." aria-label="Describe tus síntomas...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="sendMessage()" id="send-btn">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .user-message {
            font-family: 'Source Sans 3', sans-serif;
            background-color: #ffffff;
            color: #000000; 
            border-radius: 10px;
            text-align: right;
            padding: 10px;
            width: 50%;
            margin-left: auto; 
            
        }
        .bot-message {
            font-family: 'Source Sans 3', sans-serif;
            background-color: #00C8F8;
            color: #ffffff; 
            margin: 0;
            padding: 10px;
            border-radius: 10px;
            width: 50%;
        }
        
    </style>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let selectedDiagnosticoId = null;
    let currentQuestionIndex = 0;
    let answers = [];

    function appendMessage(text, isUser = false) {
        let messageClass = isUser ? 'user-message' : 'bot-message';
        let messageElement = $('<div></div>').addClass(messageClass).text(text);
        $('#chat-box').append(messageElement);
        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
    }

    function sendMessage() {
        let userInput = $('#user-input').val().trim();
        if (userInput === '') return;

        appendMessage(userInput, true);

        $.ajax({
            url: '/handleChat',
            method: 'POST',
            data: {
                response: userInput,
                current_question_index: currentQuestionIndex,
                answers: answers,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.question) {
                    currentQuestionIndex = response.current_question_index;
                    answers = response.answers;
                    $('#user-input').val('');
                    $('#user-input').attr('placeholder', response.question);
                    appendMessage(response.question);
                } else if (response.summary) {
                    appendMessage(response.summary);
                    $.ajax({
                        url: '/diagnosticoChat',
                        method: 'POST',
                        data: {
                            symptoms: response.summary,
                            diagnostico_id: selectedDiagnosticoId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(storeResponse) {
                            appendMessage(storeResponse.response);
                        },
                        error: function(error) {
                            appendMessage('Error al guardar el diagnóstico.');
                        }
                    });
                }
            },
            error: function(error) {
                appendMessage('Error al procesar la solicitud.');
            }
        });

        $('#user-input').val('');
    }

    function loadMessages(diagnosticoId) {
        selectedDiagnosticoId = diagnosticoId;

        $.ajax({
            url: '/diagnosticoChat/' + diagnosticoId,
            method: 'GET',
            data: {
                '_token': '{{ csrf_token() }}',
            },
            success: function(response) {
                $('#chat-box').empty();
                response.forEach(function(message) {
                    appendMessage(message.texto, message.es_persona);
                });
            },
            error: function() {
                appendMessage('Error al cargar los mensajes.');
            }
        });
    }

    $(document).ready(function() {
        $.ajax({
            url: '/handleChat',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.question) {
                    currentQuestionIndex = response.current_question_index;
                    answers = response.answers;
                    $('#user-input').attr('placeholder', response.question);
                    appendMessage(response.question);
                }
            }
        });
    });
</script>
@endsection
