<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'name' => 'required|min:6|max:255',
            'email' => 'required|email|unique:accounts,email,' . auth()->id() . '|min:6|max:255',
            'password' => 'nullable|min:6|max:255|confirmed',
            'password_confirmation' => 'same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống.',
            'name.min' => 'Tên tối thiểu 6 kí tự.',
            'name.max' => 'Tên tối da 255 kí tự',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email nhập không đúng định dạng.',
            'email.min' => 'Tên tối thiểu 6 kí tự.',
            'email.max' => 'Tên tối da 255 kí tự.',
            'email.unique' => 'Email đã tồn tại.',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự.',
            'password.max' => 'Mật khẩu tối da 255 kí tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password_confirmation.same' => 'Mật khẩu xác thực không trùng khớp',
        ];
    }
}
