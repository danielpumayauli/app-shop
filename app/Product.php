<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // $product->category (Consultar la categoría de un producto determinado, un producto pertenece a una categoría, se lee: un producto pertenece a una categoría)
    public function category(){
    	return $this->belongsTo(Category::class);
    }

    // $product->images (Se lee: esto (la clase Product) tiene muchas imagenes)
    
    public function images(){
     	return $this->hasMany(ProductImage::class);
     }

     // Accesor
     public function getFeaturedImageUrlAttribute(){
     	$featuredImage = $this->images()->where('featured', true)->first();
     	if(!$featuredImage){
     		$featuredImage = $this->images()->first();
     		
     	}
     	if($featuredImage){
     		return $featuredImage->url;
     	}
     	// Default
     	return '/images/products/default.jpg';
     }

}
