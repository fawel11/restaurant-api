<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'amount', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
    }
}
