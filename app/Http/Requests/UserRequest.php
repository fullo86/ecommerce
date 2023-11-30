<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username'          => 'required|max:10',
            'name'              => 'required|max:50',
            'phone'             => 'required|max:13',
            'email'             => 'required|email:rfc',
            'image_profile'     => 'mimes:jpg,JPG,jpeg,JPEG,png,PNG'
        ];
    }

    public function messages()
    {
        return [
            'username.required'     => 'Username Harus Diisi',
            'username.max'          => 'Username Maksimal 10 Karakter',
            'name.required'         => 'Nama Staff Harus Diisi',
            'name.max'              => 'Nama Staff Maksimal 50 Karakter',
            'phone.required'        => 'No Handphone Harus Diisi',
            'phone.max'             => 'No Handphone Maksimal 13 Karakter',
            'email.required'        => 'Email Harus Diisi',
            'email.email'           => 'Email Tidak Valid',
            'image_profile.mimes'   => 'Format Gambar Tidak Didukung'
        ];
    }
}
