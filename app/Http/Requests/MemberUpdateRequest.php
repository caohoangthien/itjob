<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Address;
use App\Models\Skill;
use Illuminate\Validation\Rule;

class MemberUpdateRequest extends FormRequest
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
        $skills = Skill::all(['id'])->pluck('id')->toArray();

        return [
            'name' => 'required|min:6|max:255',
            'email' => 'required|email|unique:accounts,email,' . auth()->id(),
            'password' => 'nullable|min:6|max:255|confirmed',
            'password_confirmation' => 'same:password',
            'phone' => 'required|numeric',
            'address_id' => ['required', Rule::in($address)],
            'skills_id' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'about' => 'required',
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
            'email.unique' => 'Email đã tồn tại.',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự.',
            'password.max' => 'Mật khẩu tối da 255 kí tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password_confirmation.same' => 'Mật khẩu xác thực không trùng khớp',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.numeric' => 'Số điện thoại không đúng.',
            'address_id.required' => 'Địa chỉ không được để trống.',
            'address_id.in' => 'Địa chỉ không tồn tại.',
            'skills_id.required' => 'Kỹ năng không được để trống.',
            'skills_id.in' => 'Kỹ năng không tồn tại.',
            'gender.required' => 'Giới tính không được để trống.',
            'birthday.required' => 'Ngày sinh không được để trống.',
            'about.required' => 'Giới thiệu không được để trống.',
        ];
    }
}
