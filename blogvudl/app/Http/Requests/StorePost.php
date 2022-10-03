<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
     * Check dữ liệu trả về của người dùng khi tạo một bài viết
     *
     * @return array<string, mixed>
     */
    public function rules()
    {


        return [
            'title'=>'required|unique:posts|max:255|min:5',
            'slug_post'=>'required',
            'summary'=>'required',
            
            'content'=>'required',
            'imagepost'=> 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000',
            'status'=>'required',
        ];
    }
    
    /**
     * Chuyển các trường check thông báo lỗi khi tạo bài viết thành tiếng việt
     *
     * @return void
     */
    public function messages(){
        return[
            'title.required'=>' tiêu đề không được bỏ trống',
            'title.unique' => ' tiêu đề đã tồn tại',
            'slug_post.required'=>' slug không được bỏ trống',
            'title.max' => 'tiêu đề tối đa chỉ được 255 kí tự',
            'title.min'=> 'tiêu đề phải lớn hơn 5 kí tự',
            
            'content.required'=>' nội dung không được bỏ trống',
            'summary.required' => ' tóm tắt không được bỏ trống',
            'status.required' => 'trạng thái không được bỏ trống',
            'imagepost.required'=> 'hình ảnh không được bỏ trống',
        ];
    }
}
