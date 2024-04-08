<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'unique:users'],
        ];

        if ($this->has('change_pass')) {
            $rules['password'] = ['required', 'min:6'];
            if ($this->has('re_password'))
                $rules['re_password'] = ['required_with:password', 'same:password'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên người dùng không được để trống!',
            'email.required' => 'Email người dùng không được để trống!',
            'email.unique' => 'Email người dùng không được trùng!',
            'password.required' => 'Mật khẩu không được để trống!',
            'password.min' => 'Mật khẩu phải tối thiểu 6 ký tự!',
            're_password.required_with' => 'Re-password không được để trống!',
            're_password.same' => 'Re-password khác với Password!',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
