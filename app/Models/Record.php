<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Record extends Model
{
    use HasFactory;

    protected $with = ['product'];

    public function scopeFilter($query, array $filters)
    {
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

        $query
            ->when(
                $filters['search'] ?? false,
                fn ($query, $search) =>
                $query->whereHas('product',
                    fn ($query) =>
                    $query->where('name', env('DB_REGEX'), '%'.request('search').'%')
                        ->orWhere('description', env('DB_REGEX'), '%'.request('search').'%')
                )

            );
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
