<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-CvStQ0cJYJSzs0YBETtZDpFYh8Wz5gt35ir5cq5ztkNtAty2WcILlqvG1shwnNjZ" crossorigin="anonymous"></script>
</head>


<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <x-slot name="header">
    </x-slot>
    <body class="bg-success-subtle" style="height: 500px">
    <div class="container">

        @if ($connections->isEmpty())
            <p></p>
        @else
            <h5 class="text-center p-2">You have friend request from</h5>
            <table class="table ">
                <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th class="d-flex justify-content-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($connections as $connection)

                    <tr>
                        <td>{{User::find($connection->sender_id===Auth::user()->id?$connection->receiver_id:$connection->sender_id )->firstName}}</td>
                        <td>{{User::find($connection->sender_id===Auth::user()->id?$connection->receiver_id:$connection->sender_id )->lastName}}</td>
                        <td>
                            {!! Auth::user()->id === $connection->receiver_id ? '<div class="d-flex justify-content-center">
                <div class="pr-4">
                    <form action="' . route("connection.edit", $connection->id) . '">
                        <button class="btn btn-success">Accept</button>
                    </form>
                </div>
                <div>
                    <button class="btn btn-danger">Denied</button>
                </div>
            </div>' : '<div class="d-flex justify-content-center"><button class="btn btn-primary">Connection request sent</button></div>' !!}

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <div class="bg-success-subtle p-2 pt-4 rounded">
            <h2 class="text-center"> My Friends </h2>
            <table class="table">
                <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($friends as $friend)
                    <tr>
                        <td>{{User::find($friend->sender_id===Auth::user()->id?$friend->receiver_id:$friend->sender_id)->firstName}}</td>
                        <td>{{User::find($friend->sender_id===Auth::user()->id?$friend->receiver_id:$friend->sender_id)->lastName}}</td>
                        <td>
                            <a href="{{route('connection.message',$friend->id)}}" class="btn btn-primary" >
                                <p class="m-0">Message</p>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

    </body>
</x-app-layout>
