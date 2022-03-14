<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'user_id',
        'order_number',
        'sub_total',
        'quantity',
        'delivery_charge',
        'status',
        'total_amount',
        'first_name',
        'last_name',
        'country',
        'post_code'
        ,'address1'
        ,'address2'
        ,'phone'
        ,'email'
        ,'payment_method',
        'payment_status',
        'shipping_id',
        'coupon',
        'file_1',
        'file_2',
        'file_3',
        'file_4',
        'file_5',
        'file_6',
        'pri_commande',
        'fabrication',
        'pre_alger',
        'liv_alger',
        'pre_yalidine',
        'liv_yalidine',
        'livre',
        'terminer',
        'récup_magasin',
        'annuler',
        'echouer',
        'erreur',
        'erreur',
    ];

    public function cart_info(){
        return $this->hasMany('App\Models\Cart','order_id','id');
    }
    public static function getAllOrder($id){
        return Order::with('cart_info')->find($id);
    }
    public static function countActiveOrder(){
        $data=Order::count();
        if($data){
            return $data;
        }
        return 0;
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
