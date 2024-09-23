<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class ShopOwner extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name', 
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        // 'remember_token'
    ];

    public function shops(){
        return $this->hasMany(Shop::class);
    }
}
