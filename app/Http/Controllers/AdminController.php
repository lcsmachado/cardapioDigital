<?php

namespace App\Http\Controllers;
use Auth;
use App\Model\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        $admins = Admin::where('deleted', 0)->orderBy('name')->paginate($this->totalPage);
        return view('/admin/index')->with('admins', $admins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(){
        return view('/admin/create-edit');
    }
    public function trash()
    {
        //
        $admins = Admin::where('deleted', 1)->orderBy('name')->paginate($this->totalPage);
        return view('/admin/trash')->with('admins', $admins);
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
        $admin = new Admin();
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->password = bcrypt($request['password']);
        $admin->secret_question = $request['secret_question'];
        $admin->secret_answer = $request['secret_answer'];
        $admin->role = $request['role'];
        $admin->deleted = 0;

        $this->validate($request, $admin->rules(), $this->messages());


        if ($admin->save()) {
            $notification = 'Cadastro realizado com sucesso.';
            return redirect()->route('indexAdmin')->with('notification', $notification);
        } else {
            $notification = 'Falha ao cadastrar.';
            return redirect()->back()->with('notification', $notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::where('id', $id)->first();
        return view('/admin/show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $admin = Admin::where('id', $id)->first();
        return view('/admin/create-edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::FindOrFail($id);
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->password = bcrypt($request['password']);
        $admin->secret_question = $request['secret_question'];
        $admin->secret_answer = $request['secret_answer'];
        $admin->role = $request['role'];
        
        $this->validate($request, $admin->rules(), $this->messages());

        if ($admin->save()) {
            $notification = 'Cadastro atualizado com sucesso.';
            return redirect()->route('indexAdmin')->with('notification', $notification);
        } else {
            $notification = 'Falha ao atualizar.';
            return redirect()->back()->with('notification', $notification);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::where('id', $id)->first();
         $admin->deleted = 1;
         if ($admin->save()) {
             $notification = 'Exclusão realizada com sucesso.';
             return redirect()->route('indexAdmin')->with('notification', $notification);
         } else {
             $notification = 'Falha ao excluir.';
             return redirect()->back()->with('notification', $notification);
         }
    }
    public function restore($id){
        $admin = Admin::where('id', $id)->first();
        $admin->deleted = 0;
        if ($admin->save()) {
            $notification = 'Restauração realizada com sucesso.';
            return redirect()->route('indexAdmin')->with('notification', $notification);
        } else {
            $notification = 'Falha ao Restaurar.';
            return redirect()->back()->with('notification', $notification);
        }
    }
    public function showViewResetPassword(){
        return view('/admin/resetPassword');
    }
    public function showViewResetPasswordQuestions(Request $request){

        $admin = Admin::where('email',$request['email'])->first();  
        return view('/admin/resetPasswordQuestions', compact('admin'));
    }
    public function confirmQuestions(Request $request,$email){
        $admin = Admin::where('email',$email)->first();
        if($request['secret_answer']==$admin->secret_answer){
            return view('/admin/resetPasswordNewPassword', compact('admin'));
        }
        $notification = 'Resposta Incorreta.';
        return redirect()->route('resetPass')->with('notification', $notification);
    }
    public function saveNewPassword(Request $request, $email){
        $admin = Admin::where('email',$request['email'])->first();  
        $admin->password = bcrypt($request['password']);
        
        

        if ($admin->save()) {
            $notification = 'Cadastro atualizado com sucesso.';
            return redirect()->route('login')->with('notification', $notification);
        } else {
            $notification = 'Falha ao atualizar.';
            return redirect()->route('resetPass')->with('notification', $notification);
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres.',
            'name.max' => 'O nome deve ter no máximo 45 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.min' => 'O email deve ter no mínimo 3 caracteres.',
            'email.unique' => 'O email já foi cadastrado.',
            'password.required' => 'O campo Senha deve ser selecionado.',
            'password.min' => 'O campo Senha deve ter ao menos 6 caracteres.',
            'password.confirmed' => 'As senhas devem ser iguais.',
            'secret_question.required' =>'o campo Pergunta Secreta é obrigatório.',
            'secret_answer.required'   =>'O campo Resposta Secreta é obrigatório.',
            'secret_answer.min'   =>'O campo Resposta Secreta deve ter no minimo 6 caracteres',
            'secret_answer.max'   =>'O campo Resposta Secreta deve ter no máximo 30 caracteres.',
        ];

    }
}
