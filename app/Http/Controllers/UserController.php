<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
	 public function __construct()
    {
        // Nesse caso o middleware auth será aplicado a todos os métodos
        //$this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()){
            if(Auth::user()->type == 1){
                $user = User::orderBy('name')->withTrashed()->paginate(15);
                return view('users.index')->with('user', $user);
            }else {
                return redirect()->back();
            }
        }else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {          // $role = Role::all();
               // return view('auth.register')->with('role', $role);
        if(Auth::check()){
            if(Auth::user()->type == 1){
                $role = Role::all();
                return view('auth.register')->with('role', $role);
            }else {
                return redirect()->back();
            }
        }else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(Auth::check()){
            if(Auth::user()->type == 1){

                 $mensagens = [
                    'name.required' => 'O campo nome é obrigatório',
                    'name.max' => 'O campo nome deve ter no máximo 191 caracteres',
                    'type.required' => 'O campo tipo é obrigatório',
                    'email.required' => 'O campo :attribute é obrigatório',
                    'email.unique' => 'O emails já foi cadastrado',
                    'password.required' => 'O campo senha é obrigatório',
                    'password.confirmed' => 'As senhas estão diferentes',
                    'password.min' => 'A senha deve ser maior/igual a 8 caracteres',
                ];

                $request->validate([
                    'name'=>'required|max:191|string',
                    'type' => 'required',
                    'email' => 'required|unique:users|string',
                    'password' => 'required|min:8|confirmed|string',
                ] , $mensagens);

                $user = New User();
                
                $user->name = $request->name;
                $user->type = $request->type;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();

                $request->session()->flash('success', 'Usuário Inserido');

                return redirect()->route('user.index');
            }else {
                return redirect()->back();
            }
        }else {
            return redirect()->route('login');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check()){
            if(Auth::user()->type == 1){
                $role = Role::all();
                $user = User::withTrashed()->find($id);
                return view('users.show')->with('role', $role)->with('user', $user);
            }else {
                return redirect()->back();
            }
        }else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check()){
            if(Auth::user()->type == 1){
                $role = Role::all();
                $user = User::withTrashed()->find($id);
                return view('users.edit')->with('role', $role)->with('user', $user);
            }else {
                return redirect()->back();
            }
        }else {
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $mensagens = ['name.required' => 'O campo nome é obrigatório',
        'type.required' => 'O campo :attribute é obrigatório',
        'email.required' => 'O campo :attribute é obrigatório',
        'email.email' => 'O campo :attribute é deve ser um email válido',
        'email.unique' => 'O :attribute informado já se encontra em nossa base de dados',
         ];


        if($user->email != $request->email ){
            
            $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:users',
            'type' => 'required'
            ] , $mensagens);
            $user->fill($request->all());
            $user->save(); 
        }else{
            $request->validate([
            'name'=>'required',
            'type' => 'required'
            ] , $mensagens);

            $user->fill($request->all());
            $user->save(); 
        }
            
        return redirect()->route('user.show', $user->id);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Exclusão realizada com sucesso!');
    }

    public function restore($id)
    {  

        User::onlyTrashed()->where('id', $id)->restore();
        session()->flash('success', 'Usuário ativado com sucesso!');

        return redirect()->route('user.index');
    }

    public function forceDelete($id)
    {   
        $user = User::withTrashed()->find($id);
         DB::update('update vendas set user_id = null where user_id = '.$id.'');
        $user->forceDelete();
        return redirect()->route('user.index')->with('success', 'Exclusão realizada com sucesso!');
    }
}
