<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


@if (Auth::check() && Auth::user()->isAdmin())
    <x-app-layout>
        <x-slot name="header">

        </x-slot>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                    <h3 class="display-5 text-center ">Regular users</h3>
                    <form action="{{ route('register') }}"><button class="btn btn-primary mt-4 mb-4">Add new user</button></form>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index=>$user)
                            <tr>
                                <td>{{ $index+1}}</td>
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




@else {  <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>}

@endif
</body>
</html>
