<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'delivered'  => 'sometimes|nullable|string',
            'delivery_service_id' => 'sometimes|nullable|string',
            'user_id' =>  'sometimes|nullable|string',
            'package_id' => 'sometimes|nullable|string',
            'delivery_address' => 'sometimes|nullable|string',
            'sent_at' => 'sometimes|nullable|string',
        ];
    }
}
