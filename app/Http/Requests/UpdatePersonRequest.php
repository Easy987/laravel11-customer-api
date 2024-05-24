<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'addresses' => 'sometimes|array|max:2',
            'addresses.*.address' => 'required_with:addresses|string|max:255',
            'addresses.*.type' => 'required_with:addresses|string|in:permanent,temporary',
            'contacts' => 'sometimes|required|array',
            'contacts.*.contact_type' => 'required_with:contacts|string|max:50',
            'contacts.*.contact' => 'required_with:contacts|string|max:255'
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if($this->has('addresses')) {
                $types = array_column($this->addresses, 'type');
                if(count(array_unique($types)) > 2) {
                    $validator->errors()->add('addresses', 'A person can only have one permanent and one temporary address.');
                }
            }
        });
    }
}
