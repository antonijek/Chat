<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
   <x-app-layout>
       <x-slot name="header">
       </x-slot>
       <div class="py-6 bg-success-subtle  ">
           <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  ">
               <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 " style="height: 90vh">
                   <h3 class="display-5 text-center text-success opacity-50 mb-5">Expand your network!</h3>
                   <a href="{{route('connection.index')}}" class="btn btn-success pl-4 pr-4">My friends</a>
                   <table class="table">
                       <thead>
                       <tr>
                           <th>First name</th>
                           <th>Last name</th>
                           <th class="text-center">Actions</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($users as $index=>$user)
                           <tr>
                               <td>{{ $user->firstName }}</td>
                               <td>{{ $user->lastName }}</td>
                               <td>
                                   <div class="d-flex justify-content-center">
                                       <div class="pr-4">
                                           <form action="{{ route('connection.create', $user->id) }}" >
                                               @csrf
                                               @if ($user->id !== Auth::user()->id)
                                                   @php
                                                       $connected = 'decline';
                                                       foreach ($allConnections as $connection) {
                                                           if (($connection->sender_id === Auth::user()->id && $connection->receiver_id === $user->id && $connection->status === 'accepted')
                                                               || ($connection->sender_id === $user->id && $connection->receiver_id === Auth::user()->id && $connection->status === 'accepted')) {
                                                               $connected = true;
                                                               break;
                                                           }
                                                           if (($connection->sender_id === Auth::user()->id && $connection->receiver_id === $user->id && $connection->status === 'pending')
                                                               || ($connection->sender_id === $user->id && $connection->receiver_id === Auth::user()->id && $connection->status === 'pending')) {
                                                               $connected = 'pending';
                                                               break;
                                                           }
                                                       }
                                                   @endphp
                                                   @if ($connected === 'decline')
                                                       <button  class="btn btn-success">Connect</button>
                                                   @elseif ($connected === 'pending')
                                                       <button type="button" class="btn btn-secondary disabled">Pending</button>
                                                   @else
                                                       <button type="button" class="btn btn-primary disabled">Connected</button>
                                                   @endif
                                               @endif
                                           </form>
                                       </div>
                                   </div>
                               </td>

                           </tr>
                       @endforeach
                       </tbody>
                   </table>
                   <div>
                       {{ $users->links() }}
                   </div>
               </div>
           </div>
       </div>
   </x-app-layout>
</body>
</html>
