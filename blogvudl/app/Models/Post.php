<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

/**
 * @property $id
 * @property $slug_post
 * @property $content
 * @property $imagepost
 * @property $status
 * @property $summary
 */
class Post extends Model
{
    use HasFactory;
    use ElasticquentTrait;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable=[
        'title','slug_post','content','imagepost','status','summary'
    ];
    protected $table= 'posts';
    protected $type ='_doc';



    protected $mappingProperties=array(
        'title'=>[
            'type'=>'varchar' ,
            "analyzer" => "standard",
        ],

        'slug_post'=>[
            'type'=>'varchar' ,
            "analyzer" => "standard",
        ],

        'content'=>[
            'type'=>'text' ,
            "analyzer" => "standard",
        ],

        'imagepost'=>[
            'type'=>'varchar' ,
            "analyzer" => "standard",
        ],

        'status'=>[
            'type'=>'int' ,
            "analyzer" => "standard",
        ],


    );
    
    /**
     * Thể hiện quan hệ giữa người  và bài viết. Mỗi bài viết có một người tạo
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    /**
     * Thể hiện quan hệ giữa danh mục và bài viết. Mỗi bài viết thuộc một danh mục
     * @return void
     */
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    /**
     * scope để tìm kiếm các bài viết theo tiêu đề
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeSearch($query){
        if(request('key')){
            $key =request('key');
            $query=$query->where('title','like','%'.$key.'%');
        }
        // if(request('category_id')){
        //     $query=$query->where('category_id',request('category_id'));
        // }
        return $query;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag','post_id','tag_id');
    }


    /**
     * The elasticsearch settings.
     *
     * @var array
     */
    protected $indexSettings = [
        'analysis' => [
            'char_filter' => [
                'replace' => [
                    'type' => 'mapping',
                    'mappings' => [
                        '&=> and '
                    ],
                ],
            ],
            'filter' => [
                'word_delimiter' => [
                    'type' => 'word_delimiter',
                    'split_on_numerics' => false,
                    'split_on_case_change' => true,
                    'generate_word_parts' => true,
                    'generate_number_parts' => true,
                    'catenate_all' => true,
                    'preserve_original' => true,
                    'catenate_numbers' => true,
                ]
            ],
            'analyzer' => [
                'default' => [
                    'type' => 'custom',
                    'char_filter' => [
                        'html_strip',
                        'replace',
                    ],
                    'tokenizer' => 'whitespace',
                    'filter' => [
                        'lowercase',
                        'word_delimiter',
                    ],
                ],
            ],
        ],
    ];
}
