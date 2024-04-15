<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'item_id', 'quantity'];
    protected $table = 'order_items';

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}
