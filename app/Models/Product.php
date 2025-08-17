<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // Supaya bisa gunakan factory untuk seeding & testing

    /**
     * Kolom yang bisa diisi secara mass assignment
     */
    protected $fillable = [
        'name',
        'price',
        'active',
    ];

    /**
     * Casting field agar lebih mudah diolah
     */
    protected $casts = [
        'price' => 'decimal:2', // harga otomatis format 2 angka desimal
        'active' => 'boolean',  // true/false
    ];

    /**
     * Relasi dengan Distribution (jika ada)
     */
    public function distributions()
    {
        return $this->hasMany(Distribution::class);
    }
}
