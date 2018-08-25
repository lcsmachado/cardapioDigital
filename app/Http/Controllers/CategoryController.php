<?php

namespace App\Http\Controllers;
use Auth;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $totalPage = 8;
    public function index()
    {
        //
        $categories = Category::where('deleted',0)->orderBy('name')->paginate($this->totalPage);
        return view('/category/index')->with('categories', $categories);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('/category/create-edit');
    }
    public function trash()
    {
        //
        $categories = Category::where('deleted', 1)->orderBy('name')->paginate($this->totalPage);
        return view('/category/trash')->with('categories', $categories);
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
        $category = new Category();
        $category->name = $request['name'];
        $category->deleted = 0;
        if ($request->hasFile('primaryImage') && $request->file('primaryImage')->isValid()) {
            if($category->image_url){
                $name= $category->image_url;
            }else{
                $name= str_random(20);
            }
            $extension = $request->primaryImage->extension();
            $namefile= "{$name}.{$extension}";
            $request->primaryImage->storeAs('categories',$namefile);
         }
         $category->image_url= $namefile;
        $this->validate($request, $category->rules, $this->messages());


        if ($category->save()) {
            $notification = 'Cadastro de Categoria realizado com sucesso.';
            return redirect()->route('indexCategory')->with('notification', $notification);
        } else {
            $notification = 'Falha ao cadastrar Categorias.';
            return redirect()->back()->with('notification', $notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category = Category::where('id', $id)->first();
        return view('/category/show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::where('id', $id)->first();
        return view('/category/create-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::FindOrFail($id);
        $category->name = $request['name'];
        if ($request->hasFile('primaryImage') && $request->file('primaryImage')->isValid()) {
            if($category->image_url){
                $name= $category->image_url;
            }else{
                $name= str_random(20);
            }
            $extension = $request->primaryImage->extension();
            $namefile= "{$name}.{$extension}";
            $request->primaryImage->storeAs('categories',$namefile);
         }
         $category->image_url= $namefile;
        $this->validate($request, $category->rules, $this->messages());

        
        if ($category->save()) {
            $notification = 'Cadastro realizado com sucesso.';
            return redirect()->route('indexCategory')->with('notification', $notification);
        } else {
            $notification = 'Falha ao cadastrar.';
            return redirect()->back()->with('notification', $notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::where('id', $id)->first();
        $category->deleted = 1;
        if ($category->save()) {
            $notification = 'Exclusão realizada com sucesso.';
            return redirect()->route('indexCategory')->with('notification', $notification);
        } else {
            $notification = 'Falha ao excluir.';
            return redirect()->back()->with('notification', $notification);
        }
    }
    public function restore($id){
        $category = Category::where('id', $id)->first();
        $category->deleted = 0;
        if ($category->save()) {
            $notification = 'Restauração realizada com sucesso.';
            return redirect()->route('indexCategory')->with('notification', $notification);
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
        ];

    }
}
