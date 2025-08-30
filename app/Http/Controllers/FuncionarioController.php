<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
