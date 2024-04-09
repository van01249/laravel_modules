<?php

namespace Modules\Student\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'parent_guardian_name' => 'required',
            'id_school' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên học sinh không được để trống!',
            'birthday.required' => 'Ngày sinh học sinh không được để trống!',
            'gender.required' => 'Giới tính học sinh không được để trống!',
            'phone.required' => 'Số điện thoại học sinh không được để trống!',
            'parent_guardian_name.required' => 'Người giám hộ học sinh không được để trống!',
            'id_school.required' => 'Trường học không được để trống!',
            'address.required' => 'Địa chỉ không được để trống!',
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
