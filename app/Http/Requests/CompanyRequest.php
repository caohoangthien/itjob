<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Address;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:accounts',
            'password' => 'required',
            'phone' => 'required|numeric',
            'address_id' => ['required', Rule::in($address)],
            'about' => 'required',
            'avatar' => 'required|mimes:png,jpg,jpeg|max: 1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên công ty không được để trống.',
            'name.min' => 'Tên công ty phải lớn hơn 3 kí tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email nhập không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required'  => 'Mật khẩu không được để trống.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.numeric' => 'Số điện thoại không đúng.',
            'address_id.required' => 'Địa chỉ không được để trống.',
            'address_id.in' => 'Địa chỉ không tồn tại.',
            'about.required' => 'Giới thiệu không được để trống.',
            'avatar.required' => 'Ảnh đại diện không được để trống.',
            'avatar.mimes' => 'Ảnh đại diện không đúng định dạng.',
            'avatar.max' => 'Ảnh đại diện có dung lượng dưới 1000kb.',
        ];
    }
}
