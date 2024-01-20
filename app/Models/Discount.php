<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'value', 'category_id', 'item_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function setTypeAttribute($value)
    {
        // Somehow this mutator is not mutating -- need to debug more

        if ($this->getAttribute('category_id') !== null) {
            $this->attributes['type'] = 'category';
        } elseif ($this->getAttribute('item_id') !== null) {
            $this->attributes['type'] = 'item';
        } else {
            $this->attributes['type'] = 'all_menu';
        }
    }
}
