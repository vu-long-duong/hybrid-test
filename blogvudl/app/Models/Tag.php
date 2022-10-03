<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $hot
 * @property $status
 */
class Tag extends Model
{
    use HasFactory;
        
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable=[
        'hot','content','status'
    ];

    protected $table= 'tags';

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag','post_id','tag_id');
    }
    
    
}
