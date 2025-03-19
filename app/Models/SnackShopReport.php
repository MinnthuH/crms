<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnackShopReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'snack_shop_id',
        'cinema_id',
        'date',
        'opening_balance',
        'sales',
        'save_amount',
        'total_expenses',
        'transfer_amount',
        'closing_balance',
        'surplus_deficits',
        'total_surplus_deficits',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(AdminUser::class,'user_id','id');
    }

    public function snackShop()
    {
        return $this->belongsTo(SnackShop::class,'snack_shop_id','id');
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class,'cinema_id','id');
    }
}
