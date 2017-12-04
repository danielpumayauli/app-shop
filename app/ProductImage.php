<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    // $productImage->product (Se lee: esto (la clase ProductImage) pertenece a un producto determinado)
    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
