<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    // ในไฟล์ Product.php
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
   

    protected $fillable = [
        'name',
        'image',
        'price_hot',
        'price_cold',
        'price_blended',
        'category'
    ];
}
