<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 5;

        if(!empty($keyword)){
            $products = Product::where('name', 'LIKE', "%$keyword%")->
                            orWhere ('category', 'LIKE', "%$keyword%")->
                            latest()->paginate($perPage);
        }else{
            $products = Product::latest()->paginate($perPage);
        }
        return view('products.index', ['products' => $products])->with('i', (request()->input('page', 1)-1)*5);
    }


    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        //validação

        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2028',

        ]);


        $product = new Product;
        //salvando imagem em um diretório publico
        $fileName = time() . '.' . $request->image->getClientOriginalExtension();
        request()->image->move(public_path('images'),$fileName);

        //atribuindo os valores ao modelo Product
        $product-> name        = $request->name;
        $product-> description = $request->description;
        $product-> category    = $request->category;
        $product-> quantity    = $request->quantity;
        $product-> price       = $request->price;
        $product-> image       = $fileName;

        //salvando no banco de dados
        $product->save();

        //redirecionando e exibindo mensagem de sucesso
        return redirect()->route('products.index')->with('success', ('Produto adicionado com sucesso'));
    }

 
}
