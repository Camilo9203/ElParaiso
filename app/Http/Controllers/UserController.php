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
    public function index()
    {
        $users = User::get();
        return view('users.index', [
            'users' => $users
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

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function update(User $user, UserRequest $request)
    {
        
        $user->update($request->validated());
        return  redirect()->route('user.show')->with('status', 'El usuario se ha actualizaco con exito');

    }
    public function destroy ($id)

    {
        $user = User::findOrFail($id);
        $user->delete();
        
        // $user->delete();        
        // return redirect()->route('user.index')->with('status', 'El usuario se ha eliminado con exito');
    }

}
