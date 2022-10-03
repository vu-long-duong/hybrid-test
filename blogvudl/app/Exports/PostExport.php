<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;


class PostExport implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
            
        return Post::select("title", "status", "created_at")->get();
    }

    
    public function forDay(string $daymin, string $daymax )
    {
        $this->daymin = $daymin;
        $this->daymax = $daymax;
        return $this;
    }

    public function query()
    {
        $datemin = strtotime($this->daymin);
        $datemax = strtotime($this->daymax);
        // dd(var_dump(date('Y-m-d', $datemin)));

        return Post::query()->where('created_at','<',date('Y-m-d', $datemin))->where('created_at','>',date('Y-m-d', $datemax));
    }

    public function headings(): array
    {
        return [
            'Title',
            'Status',
            'Created at',
        ];
    }

    public function map($post): array
    {
        return [
            $post->title,
            $post->status,
            $post->created_at,
        ];
    }
}
