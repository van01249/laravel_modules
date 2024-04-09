<?php

namespace Modules\School\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:schools',
                'min:15',
            ],
            'address' => 'required',
            'descriptions' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên trường học không được để trống!',
            'name.unique' => 'Tên trường học không được để trùng!',
            'name.min' => 'Tên trường học phải ít nhất 15 ký tự!',
            'address.required' => 'Địa chỉ trường học không được để trống!',
            'descriptions.required' => 'Mô tả trường học không được để trống!',
            'phone.required' => 'Số điện thoại trường học không được để trống!',
            'email.required' => 'Email trường học không được để trống!',
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
