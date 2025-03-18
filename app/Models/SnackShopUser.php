<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnackShopUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'snack_shop_id',
    ];

    public function user()
    {
        return $this->belongsTo(AdminUser::class, 'user_id', 'id');
    }

    public function snackShop()
    {
        return $this->belongsTo(SnackShop::class, 'snack_shop_id', 'id');
    }
}
