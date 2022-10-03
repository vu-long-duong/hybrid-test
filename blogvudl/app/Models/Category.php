<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $slug_category
 * @property $status
 */
class Category extends Model
{
    use HasFactory;    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable=[
        'name','slug_category','status'
    ];

    /**
     * Name table
     *
     * @var string
     */
    protected $table= 'categories';
    
    /**
     * Thể hiện quan hệ giữa danh mục và bài viết. Mỗi danh mục có nhiều bài viết
     *
     * @return void
     */
    public function posts(){
        return $this->hasMany(Post::class,'category_id');
    }
    
}
