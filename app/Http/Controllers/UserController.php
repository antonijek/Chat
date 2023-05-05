<?php

namespace App\Http\Controllers;;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Connection;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nonAdminUsers = User::where('isAdmin', 0)->paginate(6);
        return view('dashboard', ['users' =>$nonAdminUsers]);
    }

    public function showUsersWithoutMyself()
    {
        $others = User::where('isAdmin', 0)
            ->where('firstName', '!=', auth()->user()->firstName)
            ->paginate(6);
        $allConnections = Connection::all();
        return view('users.my-profile', ['users' =>$others, 'allConnections'=>$allConnections]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            return view('users.register');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        //$validatedData = $request->validated();
        $user = User::create([
            'firstName' => $request->firstName, // ['required', 'string', 'max:250', 'min:3'] is also valid
            'lastName' => $request->lastName, // ['required', 'string', 'max:250', 'min:3'] is also valid
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,User $user)
    {
       $user-> update($request->validated());
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user,Request $request)
    {
        $redirectPage = $this->calculateRedirectPage($request->perPage, $request->total, $request->currentPage);
        $user->delete();
        return redirect()->route('dashboard', ['page' => $redirectPage]);

    }


    private function calculateRedirectPage($perPage, $total, $currentPage)
    {
        if ($total < $perPage)
            return 1;

        $numberOfElementsCurrentPage = $total - ($currentPage - 1) * $perPage;
        if ($numberOfElementsCurrentPage == 1)
            return $currentPage - 1;

        return $currentPage;
    }
}
