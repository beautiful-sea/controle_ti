<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Notifications\CreatedUser;
use Illuminate\Support\Facades\Response;
use App\FolhaPagamento;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['storeFirstUser']]);
    }

    public function storeFirstUser(Request $request) {
        $user = new User;

        $user->fill($request->all());

        $user->password = Hash::make($request->password);
        $user->role = User::ROLE_ADMIN;

        $user->save();

        if (Auth::attempt(['usuario' => $request->email, 'password' => $request->password], true)) {
            return redirect()->route('home');
        }

        return redirect()->route('home');
    }

    public function index()
    {
        $this->authorize('index', User::class);

        $users = User::orderBy('name')->get();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $user = new User;

        return view('users.create', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $user = new User;

        $user->fill($request->all());

        $user->password = Hash::make($request->password);

        $user->save();

        $allAdmins = User::all()->where('role',0);

        foreach ($allAdmins as $u) {
            $u->notify(new CreatedUser($user,auth()->user()));
        }


        return redirect()->route('users.index')->with('flash.success', 'Usuário salvo com sucesso');
    }

    public function edit(User $user)
    {
        $this->authorize('edit', $user);

        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);

        $user->fill($request->all());

        if(!empty($request->personal_access_code)){
            $user->personal_access_code =  Hash::make($request->personal_access_code);
        }

        if (!empty($request->new_password)) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        if(!empty($request->personal_access_code)){
            return response(200);
        }

        return redirect()->route('users.index')->with('flash.success', 'Usuário salvo com sucesso');
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);

        $user->delete();

        return redirect()->route('users.index')->with('flash.success', 'Usuário excluído com sucesso');
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);

        return view('users.profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->fill($request->all());

        if (!empty($request->new_password)) {
            $user->password = Hash::make($request->new_password);
        }

        if ($request->hasFile('imagem')) {
            $extension = $request->file('imagem')->getClientOriginalExtension();

            $user->avatar_extension = $extension;
        }

        $user->save();

        if ($request->hasFile('imagem')) {
            $request->file('imagem')->move(base_path('/public/files/users'), sprintf('%s.%s', $user->id, $extension));
        }

        return redirect()->route('users.profile')->with('flash.success', 'Perfil salvo com sucesso');
    }

    public function checkEmail(Request $request)
    {
        if (!empty($request->id)) {
            $user = User::find($request->id);

            return (User::where('email', $request->email)
                ->where('email', '<>', $user->email)
                ->first()) ? 'false' : 'true';
        } else {
            return (User::where('email', $request->email)->first()) ? 'false' : 'true';
        }
    }

    public function checkProfileEmail(Request $request)
    {
        if ($request->email == Auth::user()->email) {
            return 'true';
        }

        $user = User::where('email', $request->input('email'))->first();

        return ($user) ? 'false' : 'true';
    }

    public function checkProfilePassword(Request $request)
    {
        $user = Auth::user();

        return (Hash::check($request->old_password, $user->password)) ? 'true' : 'false';
    }

    public function block(User $user) {
        $this->authorize('block', $user);

        $user->locked = true;

        $user->save();

        return redirect()->route('users.index')->with('flash.success', 'Usuário bloqueado com sucesso');
    }

    public function unblock(User $user) {
        $this->authorize('unblock', $user);

        $user->locked = false;

        $user->save();

        return redirect()->route('users.index')->with('flash.success', 'Usuário desbloqueado com sucesso');
    }

    public function verifyPersonalAcessToken(Request $request){

        $user = auth()->user();

        $data = $request->all();

        if(Hash::check($data['personal_access_code'], $user->personal_access_code) && !isset($data['data'])){

            

            $folhaPagamentoHoje = FolhaPagamento::where('periodo',date('Y-m-d'))->where('usuarios_id',auth()->user()->id)->first();

            $download ='Folha de Pagamento - '.date("d/m/Y",strtotime($folhaPagamentoHoje->periodo)).$folhaPagamentoHoje->extensao;

            $file_url = '/files/folha_pagamentos/'.date("Y/m",strtotime($folhaPagamentoHoje->periodo)).'/'.$folhaPagamentoHoje->usuarios_id.'.'.$folhaPagamentoHoje->extensao;


            return response(['message' => 'Acesso permitido.','file_url' => $file_url,'download'    =>  $download], 200)->header('Content-Type', 'application/json');

        }elseif(Hash::check($data['personal_access_code'], $user->personal_access_code) && isset($data['data'])){


            $folhaPagamento = FolhaPagamento::where('periodo',date("Y-m-d",strtotime($this->dateEmMysql($data['data']))))->where('usuarios_id',auth()->user()->id)->first();

            $download ='Folha de Pagamento - '.date("d/m/Y",strtotime($folhaPagamento->periodo)).$folhaPagamento->extensao;

            $file_url = '/files/folha_pagamentos/'.date("Y/m",strtotime($folhaPagamento->periodo)).'/'.$folhaPagamento->usuarios_id.'.'.$folhaPagamento->extensao;


            return response(['message' => 'Acesso permitido.','file_url' => $file_url,'download'    =>  $download], 200)->header('Content-Type', 'application/json');
        }else{
            return response(['message' => 'Código incorreto.'], 401)->header('Content-Type', 'application/json');
        }
    }
}
