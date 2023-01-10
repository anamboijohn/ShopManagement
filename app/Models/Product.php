<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        $query
        ->when($filters['search'] ?? false, fn ($query, $search) =>
        $query->where(fn($query)=>
            $query->where('name', '~*', request('search'))
            ->orWhere('description', '~*', request('search'))
            )

        );

    }

    public function records(){
        return $this->hasMany(Record::class);
    }
}
