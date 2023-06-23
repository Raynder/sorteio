<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColaboradorRequest;
use App\Models\Colaborador;
use Illuminate\Http\Request;
use App\Repositories\ColaboradorRepository;

class ColaboradorController extends Controller
{

    private ColaboradorRepository $colaboradorRepository;

    public function __construct(ColaboradorRepository $colaboradorRepository)
    {
        $this->colaboradorRepository = $colaboradorRepository;
    }

    public function index()
    {
        return view('colaboradores.index');
    }

    public function create()
    {
        return view('colaboradores.create');
    }

    public function search(Request $request)
    {
        $searchData = $request->all();
        $colaboradores = $this->colaboradorRepository->all($searchData);

        return view('colaboradores.table', [
            'colaboradores' => $colaboradores,
            'searchData' => $searchData
        ]);
    }

    public function store(ColaboradorRequest $request)
    {
        $input = $request->all();
        $colaborador = Colaborador::create($input);
        if(isset($input['foto'])){
            $colaborador->foto = $input['foto']->store('colaboradores');
            $colaborador->save();
        }

        return response()->json("Registro cadastrado com sucesso.", 200);
    }

    public function show($id)
    {
        $colaborador = $this->colaboradorRepository->find($id);
        if(!$colaborador){
            return response()->json("Registro não encontrado.", 500);
        }
        return view('colaboradores.show', compact('colaborador'));
    }

    public function edit($id)
    {
        $colaborador = $this->colaboradorRepository->find($id);
        if(!$colaborador){
            return response()->json("Registro não encontrado.", 500);
        }
        return view('colaboradores.edit', compact('colaborador'));
    }

    public function update(Request $request, $id)
    {
        $colaborador = $this->colaboradorRepository->find($id);
        if(!$colaborador){
            return response()->json("Registro não encontrado.", 500);
        }

        $input = $request->all();
        $colaborador->update($input);
        if(isset($input['foto'])){
            $colaborador->foto = $input['foto']->storeAs('public/colaboradores', $input['foto']->getClientOriginalName());
            $colaborador->save();
        }

        return response()->json("Registro atualizado com sucesso.", 200);
    }

    public function destroy($id)
    {
        $colaborador = $this->colaboradorRepository->find($id);

        if(!$colaborador){
            return response()->json("Registro não encontrado.", 500);
        }

        if(storage_path('app/public/'.$colaborador->foto)){
            unlink(storage_path('app/public/'.$colaborador->foto));
        }

        $this->colaboradorRepository->delete($colaborador);
        return response()->json("Registro excluído com sucesso.", 200);
    }
}
