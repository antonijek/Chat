<?php

namespace App\Http\Controllers;
use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateConnectionRequest;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{
    public function index(User $user, Connection $connection)
    {
        $user=User::find(Auth::user()->id);
        $connections = $user->connections;
        $friendConnections=$user->friendConnections;
        return view('connections.index', ['connections' => $connections, 'friends'=>$friendConnections]);
    }

    public function create(User $user)
    {
        return view('connections.create',['user'=>$user]) ;
    }

    public function store(Request $request )
    {
      Connection::query()->create([
          'sender_id'=>$request->me,
          'receiver_id'=>$request->friend,
      ]);

        $friend = User::find($request->friend);
        $me=User::find($request->me);

        $lastRecordId = Connection::orderBy('id', 'desc')->first()->id;
        $lastConnection = Connection::find($lastRecordId);

        $friend->connections()->attach($lastConnection->id);
        $me->connections()->attach($lastConnection->id);

        return redirect()->route('my-profile');
    }

    public function show(Connection $connection)
    {
        //
    }


    public function edit(Connection $connection)
    {
        return view('connections.edit',['connection'=>$connection]);
    }

    public function reject(Connection $connection)
    {
        return view('connections.reject',['connection'=>$connection]);
    }
    public function update(Request $request, Connection $connection)
    {
        $connection->update([
            'status'=>$request->status,
            'sender_id'=>$request->sender_id,
            'receiver_id'=>$request->receiver_id,
        ]);
        return redirect()->route('connection.index');
    }

    public function updateReject(Request $request, Connection $connection)
    {
        $connection->update([
            'status'=>$request->status,
            'sender_id'=>$request->sender_id,
            'receiver_id'=>$request->receiver_id,
        ]);
        return redirect()->route('connection.index');
    }

    public function destroy(Connection $connection)
    {
        //
    }

    public function message(Request $request, $friendId)
    {
        $connection= Connection::find($friendId);
        return view('connections.message', ['friendId' => $friendId, 'connection' => $connection]);
    }


    public function updateMessage(Request $request)
    {
        $message = [
            'sender' => $request->senderName,
            'message' => $request->message,
        ];

        $connection = Connection::find($request->connectionId);
        $messages = json_decode($connection->messages, true);
        $messages[] = $message;

        $connection->update([
            'sender_id' => $request->senderId,
            'receiver_id' => $request->receiverId,
            'messages' => json_encode($messages),
        ]);

        return redirect()->route('connection.message', ['friendId' => $connection->id]);
    }

}
