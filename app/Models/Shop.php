<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name', 
        'shop_owner_id', 
        'shop_category_id',
        'description',
        'open_hours',
        'city',
        'address'
    ];

    public function owner(){
        return $this->belongsTo(ShopOwner::class, 'shop_owner_id');
    }

    public function category(){
        return $this->belongsTo(ShopCategory::class, 'shop_category_id');
    }

    public function offers(){
        return $this->hasMany(Offer::class);
    }
}
