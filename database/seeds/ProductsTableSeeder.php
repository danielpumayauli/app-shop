<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // model factory sin relaciones
        // factory(Category::class, 5)->create();
        // factory(Product::class, 100)->create();
        // factory(ProductImage::class, 200)->create();

        $categories = factory(Category::class, 5)->create(); // Se crean en BD  categorías
        $categories->each(function($c){ // Para cada una de las categorías se ejecuta esta función, donde a cada categoría se le asignan 20 productos 
            $products = factory(Product::class, 20)->make(); // Se crean 20 productos x categoria sin guardarlos en BD
            $c->products()->saveMany($products); // Se guarda el paso anterior en la BD según la relación que haya entre categoría y productos

            $products->each(function($p){ // Para cada uno de los productos de esta categoria se ejecuta esta funcion, donde a cada producto p se le asigna una colección de 5 imágenes
                $images = factory(ProductImage::class, 5)->make(); // Se crean 5 imágenes para cada producto
                $p->images()->saveMany($images); // Se guarda el paso anterior en BD según la relación que haya entre productos e imagenes
            });
        });
    }
}
