<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\File;


class SaveFileRequest extends FormRequest
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
            'name' => [
                'required',
                'min:6',
                //Rule::unique((new File)->getTable())->ignore($this->route()->file->name ?? null)
            ],
            'created' => 'required',
            'category_id' => 'required',
            'file' => 'required'
        ];
    }
}
