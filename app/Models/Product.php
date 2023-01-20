<?php

namespace App\Models;

use Carbon\Carbon;
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
            $query->where('name', env('DB_REGEX'), '%'.request('search').'%')
            ->orWhere('description', env('DB_REGEX'), '%'.request('search').'%')
            )

        );
        if ($filters['date'] ?? false) {
            $startDate = Carbon::createFromFormat('Y-m-d', $filters['date'])->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $filters['date'])->endOfDay();
        }
        $query
            ->when(
                $filters['date'] ?? false,
                fn ($query, $date) =>
                $query->where(
                    fn ($query) =>
                    $query->whereBetween('created_at', [$startDate, $endDate])
                )

            );

    }

    public function records(){
        return $this->hasMany(Record::class);
    }
}
