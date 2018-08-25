<?php

namespace App\Http\Controllers;
use Auth;
use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $totalPage=8;
    public function index()
    {
        //
        $products = Product::where('deleted',0)->orderBy('name')->paginate($this->totalPage);
        return view('/product/index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::where('deleted',0)->orderBy('name')->get();
        return view('/product/create-edit')->with('categories', $categories);
    }

    public function trash(){
        $products = Product::where('deleted',1)->orderBy('name')->paginate($this->totalPage);
        return view('/product/trash')->with('products', $products);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $product = new Product();
        $product->name = $request['name'];
        $product->ingredients = $request['ingredients'];
        $product->price = $request['price'];
        $product->category_id = $request['category_id'];
        $product->deleted = 0;
        if ($request->hasFile('primaryImage') && $request->file('primaryImage')->isValid()) {
            if($product->image_url){
                $name= $product->image_url;
            }else{
                $name= str_random(20);
            }
            $extension = $request->primaryImage->extension();
            $namefile= "{$name}.{$extension}";
            $request->primaryImage->storeAs('products',$namefile);
         }
         $product->image_url= $namefile;
        $this->validate($request, $product->rules, $this->messages());


        if ($product->save()) {
            $notification = 'Cadastro de Categoria realizado com sucesso.';
            return redirect()->route('indexProduct')->with('notification', $notification);
        } else {
            $notification = 'Falha ao cadastrar Categorias.';
            return redirect()->back()->with('notification', $notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $categories = Category::where('deleted',0)->orderBy('name')->get();
        $product = Product::where('id', $id)->first();
        return view('/product/show', compact('product'))->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::where('deleted',0)->orderBy('name')->get();
        $product = Product::where('id', $id)->first();
        return view('/product/create-edit', compact('product'))->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $product = Product::FindOrFail($id);
        $product->name = $request['name'];
        $product->ingredients = $request['ingredients'];
        $product->price = $request['price'];
        $product->category_id = $request['category_id'];
        $product->deleted = 0;
        if ($request->hasFile('primaryImage') && $request->file('primaryImage')->isValid()) {
            if($product->image_url){
                $name= $product->image_url;
            }else{
                $name= str_random(20);
            }
            $extension = $request->primaryImage->extension();
            $namefile= "{$name}.{$extension}";
            $request->primaryImage->storeAs('products',$namefile);
         }
         $product->image_url= $namefile;

        $this->validate($request, $product->rules, $this->messages());


        if ($product->save()) {
            $notification = 'Cadastro de Categoria realizado com sucesso.';
            return redirect()->route('indexProduct')->with('notification', $notification);
        } else {
            $notification = 'Falha ao cadastrar Categorias.';
            return redirect()->back()->with('notification', $notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::where('id', $id)->first();
        $product->deleted = 1;
        if ($product->save()) {
            $notification = 'Exclusão realizada com sucesso.';
            return redirect()->route('indexProduct')->with('notification', $notification);
        } else {
            $notification = 'Falha ao excluir.';
            return redirect()->back()->with('notification', $notification);
        }
    }
    public function restore($id)
    {
        $product = Product::where('id', $id)->first();
        $product->deleted = 0;
        if ($product->save()) {
            $notification = 'Restauração realizada com sucesso.';
            return redirect()->route('indexProduct')->with('notification', $notification);
        } else {
            $notification = 'Falha ao Restaurar.';
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres.',
            'name.max' => 'O nome deve ter no máximo 45 caracteres.',
            'ingredients.required' => 'O campo Ingredientes é obrigatório.',
            'ingredients.min' => 'O campo Ingredientes deve ter no mínimo 3 caracteres.',
            'ingredients.unique' => 'O campo Ingredientes já foi cadastrado.',
            'price.required' => 'O campo preço é obrigatório.'
        ];

    }
}
