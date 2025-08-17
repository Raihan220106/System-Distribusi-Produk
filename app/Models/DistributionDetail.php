<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'distribution_id',
        'product_id',
        'qty',
        'price',
        'total',
        'created_by',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'distribution_product')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function distribution()
    {
        return $this->belongsTo(Distribution::class);
    }
}
