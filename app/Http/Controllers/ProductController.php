<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;

class ProductController extends Controller
{
    public function index(){
        $products = "teste";
        return view('products.index', ['products' => $products]);
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        $product = new Product;
        //sanvaldo imagem em um diretório publico
        $fileName = time().'.'. request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'),$fileName);
        $product-> name        = $request->name;
        $product-> description = $request->description;
        $product-> category    = $request->category;
        $product-> quantity    = $request->quantity;
        $product-> price       = $request->price;
        $product-> image       = $fileName;

        $product->save();
        return redirect()->route('products.index')->with('success', ('Produto adicionado com sucesso'));
    }

 
}
