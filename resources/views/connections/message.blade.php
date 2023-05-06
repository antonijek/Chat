
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>

    <!-- Required JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-CvStQ0cJYJSzs0YBETtZDpFYh8Wz5gt35ir5cq5ztkNtAty2WcILlqvG1shwnNjZ" crossorigin="anonymous"></script>


</head>


<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div>
        <a class="btn btn-success ml-4 mt-2" href="{{route('connection.index') }}">
            Back
        </a>
    </div>
    <div class="container bg-success-subtle w-25 mb-2 rounded p-3 d-flex flex-column justify-content-end" style="min-height: 80vh;">
        <p class="text-center text-success h2 mb-3">Chat room</p>
        @foreach(json_decode($connection->messages) as $message)
            <div class="{{$message->sender === Auth::user()->firstName ? 'text-end' : 'text-start'}} mb-3">
                <span class="{{ $message->sender === Auth::user()->firstName ? 'bg-white rounded p-1 text-end h6 ml-auto' : 'bg-white rounded p-1 text-start h6' }}  mb-2">
                    {{ $message->sender === Auth::user()->firstName ? 'me' : $message->sender[0] }}
                </span>
                <p class="mt-3 ">
                   <span class="rounded p-2 {{$message->sender === Auth::user()->firstName ? 'bg-info text-white' : 'bg-dark-subtle ' }}"> {{ $message->message }}</span>
                </p>

            </div>
        @endforeach
        <div class="mt-auto">
            <form action="{{route('connection.updateMessage',$connection->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-2 mt-5">
                    <label for="message" class="form-label">Message</label>
                    <input type="text" name ="message" class="form-control rounded" id="message">
                </div>
                <input type="hidden" name ="connectionId" value="{{$connection->id}}">
                <input type="hidden" name ="senderId" value="{{$connection->sender_id}}">
                <input type="hidden" name ="receiverId" value="{{$connection->receiver_id}}">
                <input type="hidden" name ="senderName" value="{{Auth::user()->firstName}}">
                <button class="btn btn-success">Send</button>
            </form>
        </div>
    </div>














</x-app-layout>



















