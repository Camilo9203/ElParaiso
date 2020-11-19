<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Folder;

class SaveFolderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'id' => [ 
            
                'required', 'min:4', 'max:12', Rule::unique((new Folder)->getTable())->ignore($this->route()->folder->id ?? null)

            ],
            
            'name' => [

                'required', 'min:4'
            
                ]
        ];
        
    }
}
