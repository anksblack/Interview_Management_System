@extends('layouts.master')

@push('title')
    <title>User Dashboard</title>
@endpush

@push('css')
    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Prevent scrolling */
        }

        .welcome-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            perspective: 1px; /* Required for parallax effect */
            overflow-x: hidden;
            overflow-y: auto;
        }

        .parallax::before {
            content: "";
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            transform: translateZ(-1px) scale(1.5);
            background: url('/path/to/your/background-image.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .welcome-message {
            position: relative; /* Required for z-index to work */
            z-index: 1; /* Ensures the text is above the parallax background */
            animation: fadeIn 3s ease-out, moveIn 1s ease-out;
            font-size: 2em;
            color: #493838;
            cursor: pointer; /* Indicates interactiveness */
        }

        .welcome-message:hover {
            animation: pulse 1s infinite;
        }

        /* Fade in and move up animation */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Pulse animation for hover effect */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
@endpush

@section('content')
    <div class="welcome-container">
        <h1 class="welcome-message">Hello {{ auth()->user()->name }}, welcome to Webethics Solution!</h1>
    </div>
@endsection

@section('footerScripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const welcomeMessage = document.querySelector('.welcome-message');

        welcomeMessage.addEventListener('click', () => {
            welcomeMessage.textContent = "Let's explore Webethics Solution!";
        });
    });
</script>
@endsection


