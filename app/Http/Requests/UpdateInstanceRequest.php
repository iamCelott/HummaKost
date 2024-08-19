<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInstanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('instances', 'name')->ignore($this->instance->id)],
            'address' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
        'name.required' => 'Nama sekolah tidak boleh kosong',
        'name.unique' => 'Nama sekolah sudah terdaftar',
        'address.required' => 'Alamat tidak boleh kosong',
        'address.max' => 'Alamat tidak boleh lebih dari 255 karakter',
        'description.max' => 'Deskripsi tidak boleh lebih dari 1000 karakter',

        ];
    }
}
