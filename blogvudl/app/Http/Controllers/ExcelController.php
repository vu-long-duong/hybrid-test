<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Exports\PostExport;
use App\Imports\PostImport;
use App\Http\Requests\ImportCsvFileRequest;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function importExcelUser(ImportCsvFileRequest $request){
        Excel::import(new UsersImport,request()->file('file'));
               
        return back()->with('success', 'import thành công file excel');
    }

    public function exportExcelUser() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function importExcelPost(Request $request){

        Excel::import(new PostImport,request()->file('file'));
               
        return back()->with('success', 'import thành công file excel');
    }

    public function exportExcelPost(Request $request) 
    {
        $post=Post::where('created_at','<',$request->maxdate)->where('created_at','>',$request->mindate)->get();

        //return Excel::download(new PostExport($post), 'posts.xlsx');
        // dd($post);
        return (new PostExport)->forDay($request->mindate,$request->maxdate)->download('posts.xlsx');
    }

}
