<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOfficerRequest extends FormRequest
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

        $officerId = $this->route('officer');

        return [
            'name' => 'required|string|min:3|max:100|regex:/^[a-zA-Z\s]+$/',
'badge_number' => [
    'required',
    'string',
    'min:4',
    'max:20',
    'regex:/^[A-Z0-9\-]+$/',
    Rule::unique('officers', 'badge_number')->ignore($officerId),
],            'rank' => 'required|string|min:2|max:50|in:Bripda,Briptu,Brigadir,Aipda,Aiptu,Ipda,Iptu,AKP,Kompol,AKBP,Kombes',
            'assigned_area' => 'required|string|min:3|max:100',
        ];
    }

     public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.min' => 'Nama minimal harus terdiri dari 3 karakter.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'name.regex' => 'Nama hanya boleh mengandung huruf dan spasi.',

            'badge_number.required' => 'Nomor badge wajib diisi.',
            'badge_number.string' => 'Nomor badge harus berupa teks.',
            'badge_number.min' => 'Nomor badge minimal 4 karakter.',
            'badge_number.max' => 'Nomor badge maksimal 20 karakter.',
            'badge_number.unique' => 'Nomor badge sudah digunakan.',
            'badge_number.regex' => 'Nomor badge hanya boleh berisi huruf besar, angka, dan tanda hubung (-).',

            'rank.required' => 'Pangkat wajib diisi.',
            'rank.string' => 'Pangkat harus berupa teks.',
            'rank.in' => 'Pangkat tidak valid. Pilih dari daftar resmi (Bripda - Kombes).',
            'rank.min' => 'Pangkat terlalu pendek.',
            'rank.max' => 'Pangkat terlalu panjang.',

            'assigned_area.required' => 'Area penugasan wajib diisi.',
            'assigned_area.string' => 'Area penugasan harus berupa teks.',
            'assigned_area.min' => 'Area penugasan minimal 3 karakter.',
            'assigned_area.max' => 'Area penugasan maksimal 100 karakter.',
        ];
    }
}
