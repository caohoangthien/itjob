<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Address;
use App\Model\Skill;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
            'email' => 'required|email|unique:accounts|min:6|max:255',
            'password' => 'required',
            'phone' => 'required|numeric',
            'address_id' => ['required', Rule::in($address)],
            'skills_id' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'about' => 'required',
            'avatar' => 'required|mimes:png,jpg,jpeg|max: 1000',
            'cv' => 'required|mimes:pdf,doc,docx|max: 1000',
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
            'password.required'  => 'Password không được để trống.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.numeric' => 'Số điện thoại không đúng.',
            'address_id.required' => 'Địa chỉ không được để trống.',
            'address_id.in' => 'Địa chỉ không tồn tại.',
            'skill_id.required' => 'Kỹ năng không được để trống.',
            'skill_id.in' => 'Kỹ năng không tồn tại.',
            'gender.required' => 'Giới tính không được để trống.',
            'birthday.required' => 'Ngày sinh không được để trống.',
            'about.required' => 'Giới thiệu không được để trống.',
            'avatar.required' => 'Ảnh đại diện không được để trống.',
            'avatar.mimes' => 'Ảnh đại diện không đúng định dạng.',
            'avatar.max' => 'Ảnh đại diện có dung lượng dưới 1000kb.',
            'cv.required' => 'CV không được để trống.',
            'cv.mimes' => 'CV phải là pdf, doc, docx',
            'cv.max' => 'CV có dung lượng dưới 1000kb.',
        ];
    }
}
