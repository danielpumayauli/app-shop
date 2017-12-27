<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Cart;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Para obtener los carts de un determinado usuario
    public function carts(){
        return $this->hasMany(Cart::class);
    }

    // Accesor Para el cart_id
    public function getCartIdAttribute(){
        //$carts = $this->carts // Para obtener todos los carritos asociados al usuario
        $cart = $this->carts()->where('status', 'Active')->first();
        if ($cart)
            return $cart->id;

        // else
        $cart = new Cart();
        $cart->status = 'Active';
        $cart->user_id = $this->id;
        $cart->save();

        return $cart->id;


    }
}
