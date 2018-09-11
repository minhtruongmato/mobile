<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ Tên không được trống',
            'email.required'  => 'E-Mail không được trống',
            'email.unique' => 'E-Mail đã tồn tại',
            'email.email' => 'Định dạng E-Mail không đúng',
            'phone.required' => 'Số Điện Thoại không được trống',
            'address.required' => 'Địa Chỉ không được trống',
            'password.required' => 'Mật Khẩu không được trống',
            'password.confirmed' => 'Xác Nhận Mật Khẩu và Mật Khẩu không khớp',
            'password.min' => 'Mật Khẩu phải nhiều hơn :min'
        ];
    }
}
