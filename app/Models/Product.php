<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "image",
        "price",
        "quantity",
        "category_id",
    ];

    protected $with = [
        "category:id,name"
    ];

    public function in_stock()
    {
        return $this->quantity > 0;
    }

    public function get_image_url()
    {
        return asset("http://localhost:8000/storage/$this->image");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
