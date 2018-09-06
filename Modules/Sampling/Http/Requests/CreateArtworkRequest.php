<?php

namespace Modules\Sampling\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArtworkRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reference_number' => 'required|unique:artworks',
            'client_name' => 'required',
            'division' => 'required',
            'date' => 'required|date',
            'description' => 'required',
            'note' => 'required',
            'artworkDetails' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
