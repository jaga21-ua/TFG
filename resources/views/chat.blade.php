@extends('welcome')

@section('content')
<div class="container">
    <h1>Chat de Diagnóstico</h1>
    <div class="chat-container">
        <div id="chat-box" class="chat-box"></div>
        <div class="input-group mb-3">
            <input type="text" id="user-input" class="form-control" placeholder="Describe tus síntomas..." aria-label="Describe tus síntomas...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="send-btn">Enviar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#send-btn').on('click', function() {
        sendMessage();
    });

    $('#user-input').on('keypress', function(e) {
        if (e.which == 13) {
            sendMessage();
        }
    });

    function sendMessage() {
        let userInput = $('#user-input').val().trim();
        if (userInput === '') return;

        let userMessage = $('<div class="user-message"></div>').text(userInput);
        $('#chat-box').append(userMessage);

        $.ajax({
            url: '/Diagnostico',
            method: 'POST',
            data: {
                symptoms: userInput,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                let botMessage = $('<div class="bot-message"></div>').text(response.response);
                $('#chat-box').append(botMessage);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            },
            error: function() {
                let botMessage = $('<div class="bot-message"></div>').text('Error al procesar la solicitud.');
                $('#chat-box').append(botMessage);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }
        });

        $('#user-input').val('');
    }
});
</script>
@endsection
