<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Binafy\LaravelCart\Cartable;

class Product extends Model implements Cartable
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'slug', 'description', 'price', 'quantity', 'image'];

    public function getPrice(): float
    {
        return (float) $this->price;
    }

    public function getPriceByQuantityperItem(int $itemquantity): float
    {
        return $itemquantity * (float) $this->price;
    }
}
