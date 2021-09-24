<?php

namespace Azuriom\Plugin\MuOnline\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Azuriom\Plugin\MuOnline\Models\MuOnlineAccount;

class MuOnlineAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        

        return [
            'account' => ['required', 'string', 'max:10', 'regex:/^[A-Za-z0-9]+$/u',
                function ($attribute, $value, $fail) {
                    $test = MuOnlineAccount::where('memb_name', $value)->first();
                    if ($test) {
                        $fail($attribute.' already exists.');
                    }
                }
            ],
            'password' => ['required', 'string', 'min:4','max:10', 'regex:/^[A-Za-z0-9]+$/u','confirmed'],
        ];
    }
}