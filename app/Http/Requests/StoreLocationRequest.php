<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ];
    }

       public function messages(): array
    {
        return [
            'name.required' => 'Location name is required.',
            'name.string' => 'Location name must be a valid string.',
            'name.max' => 'Location name must not exceed 100 characters.',

            'description.string' => 'Description must be a valid string.',
            'description.max' => 'Description must not exceed 1000 characters.',

            'latitude.required' => 'Latitude is required.',
            'latitude.numeric' => 'Latitude must be a number.',
            'latitude.between' => 'Latitude must be between -90 and 90.',

            'longitude.required' => 'Longitude is required.',
            'longitude.numeric' => 'Longitude must be a number.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
        ];
    }
}
