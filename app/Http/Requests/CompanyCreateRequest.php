<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Address;
use Illuminate\Validation\Rule;

class CompanyCreateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:accounts|max:255',
            'password' => 'required|min:6|max:255',
            'phone' => 'required',
            'address_id' => ['required', Rule::in($address)],
            'about' => 'required',
            'avatar' => 'required|mimes:png,jpg,jpeg|max: 1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên công ty không được để trống.',
            'name.max' => 'Tên công ty tối đa 255 kí tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email nhập không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.max' => 'Email tối đa 255 kí tự.',
            'password.required'  => 'Mật khẩu không được để trống.',
            'password.min'  => 'Mật khẩu tối thiểu 6 kí tự.',
            'password.max'  => 'Mật khẩu tối đa 255 kí tự.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'address_id.required' => 'Địa chỉ không được để trống.',
            'address_id.in' => 'Địa chỉ không tồn tại.',
            'about.required' => 'Giới thiệu không được để trống.',
            'avatar.required' => 'Vui lòng chọn ảnh đại diện.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpn, jpg, jpeg.',
            'avatar.max' => 'Ảnh đại diện có dung lượng tối đa 1000kb.',
        ];
    }
}
