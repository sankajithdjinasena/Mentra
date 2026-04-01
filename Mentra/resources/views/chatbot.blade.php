@extends('layouts.web')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <section class="container sec  wow fadeInDown">
        <h2>Study Focus Chatbot</h2>
        <iframe allow="microphone;" width="350" height="430"
            src="https://console.dialogflow.com/api-client/demo/embedded/6970697c-c0ef-4a7e-9345-54ad879609e3">
        </iframe>
    </section>






    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger intent="WELCOME" chat-title="FocusZen" agent-id="6970697c-c0ef-4a7e-9345-54ad879609e3"
        language-code="en"></df-messenger>


    <style>
        iframe {
            display: block;
            margin: 0 auto;
        }
    </style>
@endsection











{{--
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Chat Icon</title>
    <style>
        .chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .chat-icon img {
            width: 35px;
            height: 35px;
        }

        .chat-iframe {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 350px;
            height: 430px;
            border: none;
            display: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .chat-iframe.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="chat-icon" onclick="toggleChat()">
        <img src="your-icon.png" alt="Chat Icon">
    </div>

    <iframe
        class="chat-iframe"
        allow="microphone;"
        src="https://console.dialogflow.com/api-client/demo/embedded/6970697c-c0ef-4a7e-9345-54ad879609e3">
    </iframe>

    <script>
        function toggleChat() {
            const iframe = document.querySelector('.chat-iframe');
            iframe.classList.toggle('active');
        }
    </script>
</body>

</html> --}}
