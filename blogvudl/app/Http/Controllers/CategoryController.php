<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use Illuminate\Support\Facades\Paginator;
use Illuminate\Support\Facades\Log;
use Throwable;

class CategoryController extends Controller
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;
    
    /**
     * Hiển thị danh sách các danh mục 
     *
     * @return Illuminate/Contracts/View/View
     */
    public function index()
    {

        $listCategory = Category::orderBy('id', 'DESC')->paginate(5);
        return view('admin.category.index')->with(compact('listCategory'));
    }

    
    /**
     * Hiển thị giao diện của form tạo danh mục
     *
     * @return Illuminate/Contracts/View/View
     */
    public function create()
    {
        return view('admin.category.create');
    }

    
    /**
     * Tạo bài viết
     *
     * @param  mixed $request
     * @return Illuminate/Contracts/View/View
     */
    public function store(StoreCategory $request)
    {
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->slug_category = $request->slug_category;
            $category->status = $request->status;
            $save = $category->save();
        } catch (Throwable $throw) {
            Log::channel('custom_log')->error($throw->getMessage());
        }

        if ($save) {
            Log::channel('custom_log')->info('Tạo thành công danh mục ' . $request->name);

            return redirect()->back()->with('success', 'tạo thành công danh mục');
        }
        return redirect()->back()->with('errors', 'Không tạo được danh mục');
    }
    
    /**
     * Phần tìm kiếm theo tiêu đề của danh mục
     *
     * @param  mixed $request
     * @return Illuminate/Http/Response
     */
    public function search(Request $request)
    {
        $output = '';
        $category = Category::where('name', 'LIKE', '%' . $request->keyword . '%')->get();

        foreach ($category as $cate) {

            $output = ' <tr>
            
            <td scope="row">' . $cate->id . '</td>
            <td> <a href="#">' . $cate->name . '</a></td>
            <td>' . $cate->slug_category . '</td>
            <td>' . $cate->status . '</td>
            
            </tr>';
        }
        return response()->json($output);
    }

    
    /**
     * hiển thị view 
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json(['data' => $category], 200); // 200 là mã lỗi

    }
    
    /**
     * update danh mục
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(UpdateCategory $request, $id)
    {        
        $category = Category::find($id)->update($request->all());
        return response()->json(['data' => $category, 'category' => $request->all(), 'categoryid' => $id, 'message' => 'Cập nhật thông tin sinh viên thành công'], 200);
    }

    
    /**
     * xóa danh mục
     *
     * @param  mixed $id
     * @return Illuminate/Contracts/View/View
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'Xoá danh mục thành công');
    }
}
