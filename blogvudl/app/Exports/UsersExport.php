<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->created_at,
            $user->updated_at,
        ];
    }
}
