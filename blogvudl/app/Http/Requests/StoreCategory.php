<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
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
     * Check dữ liệu trả về của người dùng khi tạo danh mục
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:categories|max:255|min:5',
            'slug_category'=>'required',
            'status' =>'required'
        ];
    }
    
    /**
     * Chuyển các trường check thông báo lỗi khi tạo danh mục thành tiếng việt
     *
     * @return void
     */
    public function messages(){
        return[
            'name.required'=>' :name không được bỏ trống',
            'name.unique' => ' :name đã tồn tại',
            'name.max' => ':name tối đa chỉ được 255 kí tự',
            'name.min'=> ':name phải lớn hơn 5 kí tự',
            'slug_category.required' => ':slug_category không được bỏ trống',
            'status.require' => ':status không được bỏ trống',

        ];
    }
}
