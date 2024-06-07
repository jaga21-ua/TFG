@extends('welcome')

@section('content')
<div class="container">
    <h1>Chat de Diagnóstico</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="list-group" id="chat-list">
                @foreach($diagnosticos as $diagnostico)
                    <a href="#" class="list-group-item list-group-item-action" data-id="{{ $diagnostico->id }}" onclick="loadMessages({{ $diagnostico->id }})">
                        {{ $diagnostico->sintomas }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-8">
            <div class="chat-container">
                <div id="chat-box" class="chat-box"></div>
                <div class="input-group mb-3">
                    <input type="text" id="user-input" class="form-control" placeholder="Describe tus síntomas..." aria-label="Describe tus síntomas...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="sendMessage()" id="send-btn">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let selectedDiagnosticoId = null;

    function sendMessage() {
        let userInput = $('#user-input').val().trim();
        if (userInput === '') return;
        console.log(selectedDiagnosticoId)

        let userMessage = $('<div class="user-message"></div>').text(userInput);
        $('#chat-box').append(userMessage);

        $.ajax({
            url: '/diagnosticoChat',
            method: 'POST',
            data: {
                symptoms: userInput,
                diagnostico_id: selectedDiagnosticoId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response)
                let botMessage = $('<div class="bot-message"></div>').text(response.response);
                $('#chat-box').append(botMessage);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            },
            error: function(error) {
                console.log(error)
                let botMessage = $('<div class="bot-message"></div>').text('Error al procesar la solicitud.');
                $('#chat-box').append(botMessage);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
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
                    console.log(message)
                    let messageElement = $('<div class="' + (message.es_persona ? 'user-message' : 'bot-message') + '"></div>').text(message.texto);
                    $('#chat-box').append(messageElement);
                });
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            },
            error: function() {
                let botMessage = $('<div class="bot-message"></div>').text('Error al cargar los mensajes.');
                $('#chat-box').append(botMessage);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }
        });
    }
</script>
@endsection
