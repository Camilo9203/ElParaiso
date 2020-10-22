<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $user)
    {
        return view('users.index', ['users' => $user->paginate()]);
    }

    public function show(User $user)
    {
        $user = $user;
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function create(){

        return view('users.create', ['user' => new User]);
    }

    public function store(UserRequest $request)
    
    {

        User::create([
            
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request['password'])
             
        ]);

        return redirect()->route('user.index')->with('status', 'El usuario ha sido creado con exito');
    }

    public function edit(User $user)
    {
        return view('users.edit', [

            'user' => $user
        ]);
    }

    public function update(User $user, UserRequest $request)
    {
        
        $user->update($request->validated());
        return  redirect()->route('user.show')->with('status', 'El usuario se ha actualizaco con exito');

    }
    public function destroy (User $user)

    {
        return $user;
        
        // $user->delete();        
        // return redirect()->route('user.index')->with('status', 'El usuario se ha eliminado con exito');
    }

}
