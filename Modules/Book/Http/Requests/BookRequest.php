<?php

namespace Modules\Book\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'min:15',
            ],
            'author' => 'required',
            'genre' => 'required',
            'publisher' => 'required',
            'publish_date' => 'required',
            'quantity' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tên sách không được để trống!',
            'title.min' => 'Tên sách phải ít nhất 15 ký tự!',
            'genre.required' => 'Thể loại sách không được để trống!',
            'publisher.required' => 'Nhà xuất bản sách không được để trống!',
            'publish_date.required' => 'Ngày xuất bản sách không được để trống!',
            'quantity.required' => 'Số lượng sách không được để trống!',
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
