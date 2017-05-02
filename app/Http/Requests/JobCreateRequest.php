<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Address;
use App\Models\Salary;
use Illuminate\Validation\Rule;

class JobCreateRequest extends FormRequest
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
        $salaries = Salary::all(['id'])->pluck('id')->toArray();

        return [
            'title' => 'required|min:3|max:255',
            'skills_id' => 'required',
            'salary_id' => ['required', Rule::in($salaries)],
            'address_id' => ['required', Rule::in($address)],
            'quantity' => 'required|numeric',
            'describe' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.min' => 'Tiêu đề tối thiểu 3 kí tự.',
            'title.max' => 'Tiêu đề tối đa 255 kí tự.',
            'skills_id.required' => 'Kỹ năng không được để trống.',
            'salary_id.required' => 'Mức lương không được để trống.',
            'salary_id.in' => 'Mức lương không tồn tại.',
            'address_id.required' => 'Địa chỉ không được để trống.',
            'address_id.in' => 'Địa chỉ không tồn tại.',
            'quantity.required' => 'Số lượng không được để trống.',
            'quantity.numeric' => 'Vui lòng nhập số lượng.',
            'describe.required' => 'Mô tả công việc không được để trống',
        ];
    }
}