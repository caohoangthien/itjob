<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Address;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
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
        $address = Address::all(['id'])->pluck('id')->toArray();

        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:accounts,email,' . auth()->id(),
            'password' => 'nullable|min:6|max:255|confirmed',
            'password_confirmation' => 'same:password',
            'phone' => 'required|numeric',
            'address_id' => ['required', Rule::in($address)],
            'about' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên công ty không được để trống.',
            'name.min' => 'Tên công ty ít nhất 3 kí tự.',
            'name.max' => 'Tên công ty tối đa 255 kí tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email nhập không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự.',
            'password.max' => 'Mật khẩu tối da 255 kí tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password_confirmation.same' => 'Mật khẩu xác thực không trùng khớp',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.numeric' => 'Số điện thoại không đúng.',
            'address_id.required' => 'Địa chỉ không được để trống.',
            'address_id.in' => 'Địa chỉ không tồn tại.',
            'about.required' => 'Giới thiệu không được để trống.',
        ];
    }
}
