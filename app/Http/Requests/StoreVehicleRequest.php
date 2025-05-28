<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'license_plate' => 'required|string|max:20',
            'type'          => 'required|string|in:mobil,motor',
            'brand'         => 'required|string|max:50',
            'color'         => 'required|string|max:30',
            'is_stolen'     => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'license_plate.required' => 'Nomor plat polisi harus diisi.',
            'license_plate.string'   => 'Nomor plat polisi harus berupa teks.',
            'license_plate.max'      => 'Nomor plat polisi maksimal 20 karakter.',

            'type.required'          => 'Jenis kendaraan harus diisi.',
            'type.string'            => 'Jenis kendaraan harus berupa teks.',
            'type.in'                => 'Jenis kendaraan hanya boleh "mobil" atau "motor".',

            'brand.required'         => 'Merek kendaraan harus diisi.',
            'brand.string'           => 'Merek kendaraan harus berupa teks.',
            'brand.max'              => 'Merek kendaraan maksimal 50 karakter.',

            'color.required'         => 'Warna kendaraan harus diisi.',
            'color.string'           => 'Warna kendaraan harus berupa teks.',
            'color.max'              => 'Warna kendaraan maksimal 30 karakter.',

            'is_stolen.required'     => 'Status kehilangan harus diisi.',
            'is_stolen.boolean'      => 'Status kehilangan harus berupa true atau false.',
        ];
    }
}
