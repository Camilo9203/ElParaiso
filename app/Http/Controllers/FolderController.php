<?php


namespace App\Http\Controllers;

use App\Http\Requests\SaveFolderRequest;
use App\Models\File;
use App\Models\Folder;
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
        $folders = Folder::orderby('name')->paginate();
        return view('folders.index', compact('folders'));
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
        
            return redirect()->route('folders.index')->with('status', 'La carpeta fue creada con exito');
        }
        else {
            return redirect()->route('folders.index')->with('status', 'La carpeta no ha podido ser creada');;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        
        $folder = $folder;
        
        return view('folders.show', [

            'folder' => $folder
        ]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
