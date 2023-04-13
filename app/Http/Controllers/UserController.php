<?php

namespace App\Http\Controllers;;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nonAdminUsers = User::where('is_admin', null)->paginate(6);
        return view('dashboard', ['users' =>$nonAdminUsers]);


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
        $validatedData = $request->validated();
        $user = User::create($validatedData);
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
