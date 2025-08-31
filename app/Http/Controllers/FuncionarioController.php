<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuncionarioRequest;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class FuncionarioController extends Controller
{
    /**
     * GET /funcionarios
     * 
     * Tela de listagem de funcionários.
     */
    public function index(Request $request)
    {
        $funcionario = Funcionario::query()
            ->whereBelongsTo(Auth::user(), 'admin')
            ->with('admin')
            ->paginate(Funcionario::QUANTIDADE_POR_PAGINA)
            ->appends(request()->query());

        return Inertia::render('Funcionarios/Index', [
            'funcionarios' => $funcionario
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Funcionarios/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFuncionarioRequest $request)
    {
        $data = $request->validated();

        $funcionario = new Funcionario();
        $funcionario->fill($data);
        $funcionario->password = $data['password'];
        $funcionario->endereco = $this->montarEnderecoFinal($data['endereco'], $data['numero'], $data['complemento']);
        $funcionario->admin_id = Auth::user()->id;
        $funcionario->save();

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funcionario $funcionario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $funcionario)
    {
        //
    }

    private function montarEnderecoFinal($endereco, $numero, $complemento)
    {
        $partes = explode(',', $endereco);
        $logradouro = $partes[0];
        $restante = $partes[1];

        return $logradouro . ', nº ' . $numero . ', ' . $complemento . ',' . $restante;
    }
}
