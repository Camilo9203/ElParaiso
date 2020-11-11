<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(User $user, Folder $folder, File $file)
    {
        
        // $CountUser = DB::table('users')->count('*');
        // $CountFile = DB::table('files')->count('*');
        // $CountFolder = DB::table('folders')->count('*');
        // $CountUser = DB::select('SELECT COUNT(*) id FROM users');


        return view('dashboard', [
            'users' => $user,
            'folders' => $folder,
            'files' => $file
            
        ]); 

    }
}
