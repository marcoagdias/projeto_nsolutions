<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    /*public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }*/

    public function index()
    {
        //$users = DB::select('SELECT * FROM users');
        //dd($users);
        
        $users = User::paginate(10);
        //dd($users);

        foreach ($users as $user) {
            $user->idade = Carbon::parse($user->data_nascimento)->age;
        }

        return view('users.index')->with('users', $users);        
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_completo' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'telefone' => 'required|string|max:15',
            'cep' => 'required|string|max:9',
            'endereco' => 'required|string|max:255',
            'numero_casa' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'status_usuario' => 'required|string|max:50',
            'senha' => 'required|string|min:8',
        ]);

        $usuario = new Users();
        $usuario->nome_completo = $request->nome_completo;
        $usuario->cpf = $request->cpf;
        $usuario->email = $request->email;
        $usuario->telefone = $request->telefone;
        $usuario->cep = $request->cep;
        $usuario->endereco = $request->endereco;
        $usuario->numero_casa = $request->numero_casa;
        $usuario->complemento = $request->complemento;
        $usuario->bairro = $request->bairro;
        $usuario->cidade = $request->cidade;
        $usuario->estado = $request->estado;
        $usuario->data_nascimento = $request->data_nascimento;
        $usuario->status_usuario = $request->status_usuario;
        $usuario->senha = Hash::make($request->senha);
        
        $usuario->save();

        return redirect()->back()->with('status', 'Usuário Criado Com Sucesso');
    }

    public function show($id)
    {
        $user = Users::find($id);

        return response()->json($user);
    }

    public function edit($id)
    {   
        $user = Users::find($id);
        return response()->json($user);
    }

    public function update(Request $request)
    {           
        $user_id = $request->input('id_edit');
        $usuario = Users::find($user_id);
        
        $usuario->nome_completo = $request->input('nome_completo');
        $usuario->cpf = $request->input('cpf');
        $usuario->email = $request->input('email');
        $usuario->telefone = $request->input('telefone');
        $usuario->cep = $request->input('cep');
        $usuario->endereco = $request->input('endereco');
        $usuario->numero_casa = $request->input('numero_casa');
        $usuario->complemento = $request->input('complemento');
        $usuario->bairro = $request->input('bairro');
        $usuario->cidade = $request->input('cidade');
        $usuario->estado = $request->input('estado');
        $usuario->data_nascimento = $request->input('data_nascimento');
        $usuario->status_usuario = $request->input('status_usuario');
        $usuario->senha = Hash::make($request->input('senha'));
        $usuario->update();

        /**$user->update([
            'nome_completo' => $request->nome_completo,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'cep' => $request->cep,
            'endereco' => $request->endereco,
            'numero_casa' => $request->numero_casa,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'data_nascimento' => $request->data_nascimento,
            'status_usuario' => $request->status_usuario,
            'senha' => $request->senha && trim($request->senha) !== '' ? Hash::make($request->senha) : $user->senha,
        ]);**/
        
        return redirect()->back()->with('status', 'Usuário Atualizado Com Sucesso');
    }

    public function destroy(Request $request)
    {
        
        $id = $request->input('del_usuario_id');

        $usuario = Users::find($id);

        $usuario->delete();

        return redirect()->back()->with('status', 'Usuário Excluído com Sucesso!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string|max:14',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('cpf', $request->cpf)->first();

        if ($user && Hash::check($request->password, $user->senha)) {
            // Autenticação bem-sucedida, logando o usuário
            Auth::login($user);

            return redirect()->route('users.index')->with('success', 'Login realizado com sucesso!');
        } else {
            // Autenticação falhou, retornando com erro
            return back()->withErrors([
                'cpf' => 'As credenciais fornecidas estão incorretas.',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

}