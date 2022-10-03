<?php

namespace App\Imports;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class PostImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::where('id',$row[7])->first();
        $category = Category::where('id',$row[8])->first();

        return new Post([
            'title' => $row[0],
            'slug_post' => $row[1], 
            'content' => $row[2],
            'imagepost' => $row[3],
            'summary' => $row[4],
            'status' => $row[6],
            'user_id' => $user->id ?? NULL,
            'category_id' => $category->id ?? NULL,
        ]);
    }
}
