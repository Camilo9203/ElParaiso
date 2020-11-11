<?php


namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SaveFileRequest;
use App\Http\Requests\SaveFolderRequest;
use App\Models\File;
use App\Models\Folder;
use App\Models\Category;
use Hamcrest\Core\HasToString;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Session\Store as SessionStore;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');   
    }
    
    public function index()
    {
        $folders = Folder::with('files')->get();
        return $folders;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('folders.create', [
            
            'folder' => new Folder
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveFolderRequest $request)
    {

         
        $nameFolder = $request->input('id');
        $namePath = "/" . $nameFolder;
        

        Storage::makeDirectory($nameFolder);

        if (Storage::exists($nameFolder)) {

            Folder::create([

                'id' => $request->input('id'),
                'name' => $request->input('name'),
                'path' => $namePath
            
            ]);
        
        
        }
        else {
             
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($folder)
    {
        
        return Folder::where('id', $folder)->with('files')->first();
        
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveFolderRequest $request)
    {
        $folder = Folder::findOrFail($request->id);
        
    
            Folder::updated([

                'name' => $request->input('name'),
            
            ]);
            
            return $folder;
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder = Folder::findOrFail($id);
        $folder->delete($id);
        Storage::deleteDirectory($folder->id);
        
    }
}
