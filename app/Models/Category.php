<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
    }
    public function getTypeAttribute()
    {
        if ($this->items->isNotEmpty()) {
            return 'item';
        }

        if ( $this->parent()->isEmpty() ) {
            return 'category';
        }
        return 'subcategory';
    }

    public function level()
    {
        return $this->parent ? $this->parent->level() + 1 : 0;
    }
}
