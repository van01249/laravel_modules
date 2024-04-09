<?php

namespace Modules\StudentBook\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_student' => 'required',
            'id_book' => 'required',
            'checkout_date' => 'required|date',
            'return_date' => [
                'required',
                'date',
                // Sử dụng quy tắc kiểm tra tùy chỉnh
                function ($attribute, $value, $fail) {
                    $checkoutDate = $this->input('checkout_date');

                    if ($value <= $checkoutDate) {
                        $fail('Ngày trả phải lớn hơn ngày mượn.');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'id_student.required' => 'Tên học sinh không được để trống!',
            'id_book.required' => 'Ngày sinh học sinh không được để trống!',
            'checkout_date.required' => 'Giới tính học sinh không được để trống!',
            'return_date.required' => 'Số điện thoại học sinh không được để trống!',
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
