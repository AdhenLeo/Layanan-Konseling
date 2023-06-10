<?php

namespace App\Http\Requests\pertemuan;

use Illuminate\Foundation\Http\FormRequest;

class PostPertemuanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tema' => 'required',
            'tgl' => 'required',
            'tmpt' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tema.required' => 'Tema pertemuan tidak boleh kosong!',
            'tgl.required' => 'Tanggal pertemuan tidak boleh kosong!',
            'tmpt.required' => 'Tempat pertemuan tidak boleh kosong!',
        ];
    }
}
