<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Address;
use Illuminate\Validation\Rule;

class MemberCreateRequest extends FormRequest
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
            'skills_id' => 'required',
            'gender' => ['required', Rule::in(['1', '2'])],
            'about' => 'required',
            'avatar' => 'required|mimes:png,jpg,jpeg|max:1000',
            'cv' => 'required|mimes:pdf|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống.',
            'name.max' => 'Tên tối da 255 kí tự',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email nhập không đúng định dạng.',
            'email.max' => 'Tên tối da 255 kí tự.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required'  => 'Mật khẩu không được để trống.',
            'password.min'  => 'Mật khẩu tối thiểu 6 kí tự.',
            'password.max'  => 'Mật khẩu tối đa 255 kí tự.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'address_id.required' => 'Địa chỉ không được để trống.',
            'address_id.in' => 'Địa chỉ không tồn tại.',
            'skills_id.required' => 'Kỹ năng không được để trống.',
            'gender.required' => 'Giới tính không được để trống.',
            'gender.in' => 'Giới tính không tồn tại.',
            'birthday.required' => 'Ngày sinh không được để trống.',
            'birthday.date' => 'Ngày sinh phải có định dạng dd-mm-yyyy.',
            'birthday.date_format' => 'Ngày sinh phải có định dạng dd-mm-yyyy.',
            'birthday.before' => 'Ngày sinh phải là ngày trong quá khứ.',
            'about.required' => 'Giới thiệu không được để trống.',
            'avatar.required' => 'Vui lòng chọn ảnh đại diện.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpn, jpg, jpeg.',
            'avatar.max' => 'Ảnh đại diện có dung lượng tối đa 1000kb.',
            'cv.required' => 'Vui lòng đính kèm CV.',
            'cv.mimes' => 'CV phải phải có đinhj dạng pdf',
            'cv.max' => 'CV có dung lượng dưới 1000kb.',
        ];
    }
}
