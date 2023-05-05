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

                    <h3 class="display-5 text-center text-success opacity-50">Users</h3>
                    <form action="{{ route('user.register') }}"><button class="btn btn-primary mt-4 mb-4">Add new user</button></form>

                    <table class="table">
                        <thead>
                        <tr>

                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index=>$user)
                            <tr>

                                <td>{{ $user->firstName }}</td>
                                <td>{{ $user->lastName }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="pr-4 "> <form  action="{{route('user.edit',$user->id)}}">

                                                <button class="btn btn-success">Edit</button>
                                            </form></div>

                                        <div> <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="currentPage" value="{{ $users->currentPage()}}">
                                                <input type="hidden" name="total" value="{{ $users->total()}}">
                                                <input type="hidden" name="perPage" value="{{ $users->perPage()}}">
                                                <button class="btn btn-danger">Delete</button>
                                            </form></div>


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
