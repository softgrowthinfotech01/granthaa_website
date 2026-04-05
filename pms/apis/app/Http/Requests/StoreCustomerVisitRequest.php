<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerVisitRequest extends FormRequest
{
    public function authorize()
    {
        return true; // adjust if you want role-based access
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:191',
            'contact_no' => 'required|string|max:20',
            'aadhaar_number' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
            'site_location' => 'required|exists:location_master,id',
            'visited_at' => 'nullable|date',
            'remark' => 'nullable|string|max:1000',
        ];
    }
}