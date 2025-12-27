<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\EventStatus;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Siapa saja yg login boleh create, nanti diatur middleware
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'category' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'responsibilities' => 'required|string',
            'event_date' => 'required|date|after:today', // Best practice: date harus masa depan
            'location' => 'required|string',
            'salary' => 'nullable|string',
            // Default status handle di controller atau database default
        ];
    }
}