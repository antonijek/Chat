<?php


use App\Models\User;


?>
<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
            crossorigin="anonymous"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            conection create
        </h2>
    </x-slot>
    <body class="bg-red-200" style="height: 500px">
    <div class="container justify-center bg-success-subtle p-5 mt-5 align-items-center d-flex rounded" style="height: 300px; width: 500px">
        <form method="POST" action="{{ route('connection.updateReject',$connection->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input type="hidden" name="status" value="denied" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <input type="hidden" name="sender_id" value="{{$connection->sender_id}}" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <input type="hidden" name="receiver_id" value="{{$connection->receiver_id}}"   class="form-control" aria-describedby="emailHelp">
            </div>
            <h4>Da li zelite da odbijete zahtjev za prijateljstvo korisnika {{User::find($connection->sender_id)->firstName}} {{ User::find($connection->sender_id)->lastName}}</h4>
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-success pl-4 pr-4">Da</button>
                <a class="btn btn-secondary btn-lg" href="{{ url()->previous() }}">
                    Ne
                </a>
            </div>

        </form>

    </div>
    </body>



</x-app-layout>
