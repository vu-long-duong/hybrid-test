<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class TagController extends Controller
{
    const HOT_OFF = 0;
    const HOT_ON = 1;
    
    /**
     * Hiển thị các tag
     *
     * @return Illuminate/Contracts/View/View
     */
    public function index()
    {
        $listTag = Tag::orderBy('id', 'DESC')->paginate(5);
        return view('admin.tag.index')->with(compact('listTag'));
    }

    
    /**
     * hiển thị view tạo tag
     *
     * @return Illuminate/Contracts/View/View
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    
    /**
     * Tạo các tag
     *
     * @param  mixed $request
     * @return Illuminate/Contracts/View/View
     */
    public function store(Request $request)
    {

        try {
            $tag = new Tag();
            $tag->content = $request->content;

            $tag->status = $request->status;

            if ($request->has('hot')) {
                $tag->hot = self::HOT_ON;
            } else {
                $tag->hot = self::HOT_OFF;
            }

            $save = $tag->save();

        } catch (Throwable $throw) {
            Log::channel('custom_log')->error($throw->getMessage());
        }

        if ($save) {
            Log::channel('custom_log')->info('Tạo thành công Tag ' . $request->content);

            return redirect()->back()->with('success', 'tạo thành công Tag');
        }
        return redirect()->back()->with('errors', 'Không tạo được Tag');
        
    }


    
    /**
     * hiển thị view update Tag
     *
     * @param  mixed $id
     * @return Illuminate/Contracts/View/View
     */
    public function edit( $id)
    {
        $tag = Tag::find($id);
        return view('admin.tag.edit')->with(compact('tag'));
    }

    
    /**
     * Cập nhật tag
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return Illuminate/Contracts/View/View
     */
    public function update(Request $request, $id)
    {
        try {
            $tag = Tag::find($id);
            $tag->content = $request->content;
            $tag->status = $request->status;
            
            if ($request->has('hot')) {
                $tag->hot = self::HOT_ON;
            } else {
                $tag->hot = self::HOT_OFF;
            }

            $save = $tag->save();
        } catch (Throwable $throw) {
            Log::channel('custom_log')->error($throw->getMessage());
        }
        if ($save) {
            Log::channel('custom_log')->info('Sửa thành công Tag: ' . $request->content);
            return redirect()->back()->with('success', 'Sửa thành công Tag');
        }

        return redirect()->back()->with('errors', 'Không sửa được Tag');
    }

    
    /**
     * Xóa các tag
     *
     * @param  mixed $id
     * @return Ilum
     */
    public function destroy($id)
    {
        Tag::find($id)->delete();
        return redirect()->back()->with('success', 'Xoá tag thành công');
    }
    
    /**
     * Tìm kiếm tag theo nội dung tag
     *
     * @param  mixed $request
     * @return Illuminate/Contracts/View/View
     */
    public function search(Request $request){
        $output='';
        $tags= Tag::where('content', 'LIKE','%'.$request->keyword.'%')->get();

        foreach($tags as $tag){
            
            $output=' <tr>           
            <td scope="row">'.$tag->id.'</td>
            <td> <a href="#">'.$tag->content.'</a></td>
            <td>'.$tag->stats.'</td>
            </tr>';
        }
        return response()->json($output);
    }
}
