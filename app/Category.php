<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // $category-products (Desde categoria quiero acceder a productos, se lee: una categoría tiene muchos productos)
	public function products(){
		return $this->hasMany(Product::class);
	}
}
