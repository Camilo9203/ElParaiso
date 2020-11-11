<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveFileRequest;
use App\Models\Category;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::with('folder', 'category')->get();
        return  $files;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveFileRequest $request)
    {

        $folder = $request->input('folder_id');
        $path = $folder . "/";
        $name = $request->input('name') . ".pdf";
        $pathFile = $path . $name;

        if ($request->hasFile('file')) {
            
            $file = $request->file('file');
            Storage::putFileAs($path, $file, $name);

            File::create([ 

                'name' => $request->input('name'),
                'created' => $request->input('created'),
                'category_id' => $request->input('category_id'),
                'folder_id' => $folder,
                'file' => $pathFile,

            ]);    

        }
        else {
            return 'Sin archivo';
        }
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($file)
    {
        
        return File::findOrFail($file);
        
    }


    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function download($id)
   {
      $file = File::findOrFail($id);
      $path = $file->file;
      $headers = array(
        'Content-Type: application/pdf',
        );
      return response()->download(public_path("folders/" . $path, $headers));
        
   }

   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveFileRequest $request)
    {
        $file = File::findOfFail($request->id);
        Storage::delete($file->file);


        $folder = $request->input('folder_id');
        $path = $folder . "/";
        $name = $request->input('name') . ".pdf";
        $pathFile = $path . $name;

        if ($request->hasFile('file')) {
            
            $file = $request->file('file');
            Storage::putFileAs($path, $file, $name);

            File::updated([ 

                'name' => $request->input('name'),
                'created' => $request->input('created'),
                'category_id' => $request->input('category_id'),
                'folder_id' => $folder,
                'file' => $pathFile,

            ]);    

        }
        else {
            return 'Sin archivo';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        $path = $file->file;
        Storage::delete($path);
        $file->delete();
    }
}
