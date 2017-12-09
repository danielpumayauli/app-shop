<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index(){
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products')); // Ver listado de productos
    }

    public function create(){
    	return view('admin.products.create'); // Ver formulario de registro
    }

    public function store(Request $request){

    	// Validación
    	$messages = [
    		'name.required' => 'Debe ingresar un nombre para el producto',
    		'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
    		'description.required' => 'La descripción corta es un campo obligatorio',
    		'description.max' => 'La descripción corta solo admite asta 200 caracteres',
    		'price.required' => 'Es obligatorio definir un precio para el producto',
    		'price.numeric' => 'Ingrese un precio válido',
    		'price.min' => 'No se admiten valores negativos'
    	];
    	$rules = [
    		'name' => 'required|min:3',
    		'description' => 'required|max:200',
    		'price' => 'required|numeric|min:0'
    	];
    	$this->validate($request, $rules, $messages);

    	//registrar el nuevo producto en la bd
    	//dd($request->all());  dd() permite imprimir en la página el contenido del request y terminar la ejecución en ese instante.

    	$product = new Product();
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->long_description = $request->input('long_description');
    	$product->save(); // INSERT en la tabla producto

    	return redirect('/admin/products');

    }

    public function edit($id){
    	//El metodo recoge el id capturado en la ruta
    	//return "Mostrar aqui el form de edicion del producto con $id";
    	$product = Product::find($id);
    	return view('admin.products.edit')->with(compact('product')); // Ver formulario de registro
    }

    public function update(Request $request, $id){

    	// Validación
    	$messages = [
    		'name.required' => 'Debe ingresar un nombre para el producto',
    		'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
    		'description.required' => 'La descripción corta es un campo obligatorio',
    		'description.max' => 'La descripción corta solo admite asta 200 caracteres',
    		'price.required' => 'Es obligatorio definir un precio para el producto',
    		'price.numeric' => 'Ingrese un precio válido',
    		'price.min' => 'No se admiten valores negativos'
    	];
    	$rules = [
    		'name' => 'required|min:3',
    		'description' => 'required|max:200',
    		'price' => 'required|numeric|min:0'
    	];
    	$this->validate($request, $rules, $messages);
    	
    	//El metodo recoge el id capturado en la ruta
    	//registrar el nuevo producto en la bd
    	//dd($request->all());  dd() permite imprimir en la página el contenido del request y terminar la ejecución en ese instante.

    	$product = Product::find($id);
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->long_description = $request->input('long_description');
    	$product->save(); // UPDATE en la tabla producto

    	return redirect('/admin/products');

    }

    public function destroy($id){
    //El metodo recoge el id capturado en la ruta
		$product = Product::find($id);
		$product->delete(); // DELETE en la tabla producto

		return back();

    }
}
