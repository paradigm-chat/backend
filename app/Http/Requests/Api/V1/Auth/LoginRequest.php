<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\DataTransfers\Auth\LoginData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'phone' => ['required'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = $this->validator->validated();

        return LoginData::from([
            'phone' => $data['phone']
        ]);
    }
}
