<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\productImage;
use File;

class ImageController extends Controller
{
    public function index($id){
        $idDecript = decrypt($id);
    	$product = Product::find($idDecript);
    	$images = $product->images()->orderBy('featured', 'desc')->get();
    	return view('admin.products.images.index')->with(compact('product', 'images'));
    }

    public function store(Request $request, $id){

    	//Recoger en una variable la imagen en el proyecto temporalmente
    	$file = $request->file('photo');
    	$path = public_path() . '/images/products';
    	$fileName = uniqid() . $file->getClientOriginalName();
    	$moved = $file->move($path, $fileName);

    	// crear 1 registro en la tabla product_images
    	if($moved){
	    	$productImage = new ProductImage();
	    	$productImage->image = $fileName; // Nombre único generado arriba
	    	//$productImage->featured = false;
	    	$productImage->product_id = $id; // id del producto al que pertenece
	    	$productImage->save(); // INSERT
    	}
    	return back();

    }

    public function destroy(Request $request, $id){
    	// Eliminar el archivo
    	$productImage = ProductImage::find($request->input('image_id')); // Usar $request->input('image_id') ó $request->image_id)
    	//Validar si es o no un archivo real
    	if(substr($productImage->image, 0, 4) === "http"){
    		$deleted = true;
    	}else{
    		$fullPath = public_path() . '/images/products/' . $productImage->image; // Ruta
    		$deleted = File::delete($fullPath); // Borrará el file en esa ruta existente en el contenedor(true: si se  ha borrado, false: no se ha borrado)
    	}
    	// Proceder siempre a eliminar el registro en la BD
    	if($deleted){
    		$productImage->delete();
    	}
    	return back();
    }

    public function select($id, $image){
    	ProductImage::where('product_id', $id)->update([
    		'featured' => false
    	]);

    	$productImage = ProductImage::find($image);
    	$productImage->featured = true;
    	$productImage->save(); // Hace UPDATE

    	return back();
    }
}
