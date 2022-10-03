<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{    
    /**
     * Hiển thị người dùng theo thứ tự giảm dần của id
     *
     * @return Illuminate/Contracts/View/View
     */
    public function index(){
        $listUser= User::orderBy('id','DESC')->get();
        return view('admin.user.index')->with(compact('listUser'));
    }
        
    /**
     * Tìm kiếm người dùng
     *
     * @return void
     */
    public function search(Request $request){
        $output='';
        $users= User::where('name', 'LIKE','%'.$request->keyword.'%')->get();

        foreach($users as $user){
            
            $output=' <tr>           
            <td scope="row">'.$user->id.'</td>
            <td> <a href="#">'.$user->name.'</a></td>
            <td>'.$user->email.'</td>
            </tr>';
        }
        return response()->json($output);
    }
        
    /**
     * Xóa người dùng
     *
     * @param  mixed $id
     * @return Illuminate/Contracts/View/View
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success','Xoá người dùng thành công');
    }

}
