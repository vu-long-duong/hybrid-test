<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post as PostModel;

class Post extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // PostModel::create([
        //     'title'=> "tile create job". time(),
        //     'slug_post' => "slug post create job". time(),
        //     'content' => "Content create job oooooooooo" .time(),
        //     'imagepost' => "image6315a697e68af.jpeg",
        //     'summary' => "summary create job" .time(),
        //     'status' => 1,
        //     'user_id' =>1,
        //     'category_id'=>1,
        // ]);
        echo ' xin chao';
    }
}
