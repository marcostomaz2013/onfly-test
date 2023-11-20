<?php


namespace App\Http\Controllers\Despesa;
use App\Http\Controllers\Controller;

class DespesaController extends Controller{


    //método que lista todas as despesas

    public function index(){
        try{
            $despesas = Despesa::where('user_id', '=', $user_id)->get();

            return view('pages.despesa.index', ['despesas'=> $despesas]);
        }catch(\Exception $e){

        }
    }

    public function create(){
        try{
            return view('pages.despesa.createDespesa');
        }catch(\Exception $e){

        }
    }

    public function update(){
        try{
            if(isset($id)){
                Despesa::where('id','=', $request->id)->update([
                    'nome'=> $request->name,
                    'email'=> $request->email,
                    'data_nascimento' => $request->data_nascimento
                ]);
                return redirect(route('despesa.index'))->with('success', 'Despesa atualizada com sucesso!');
            }else{
                Despesa::create([
                    'nome'=> $request->name,
                    'email'=> $request->email,
                    'data_nascimento' => $request->data_nascimento
                ]);
                return redirect(route('despesa.index'))->with('success', 'Despesa criada com sucesso!');
            }

        }catch(Exeception $e){
            return redirect(route('despesa.index'))->withErrors('Ocorreu um erro ao cadastrar/editar a despesa!');
        }
    }
    
    public function save(){
        try{
            return view('pages.despesa.createDespesa');
        }catch(\Exception $e){

        }
    }

    public function delete(){
        try{
            Despesa::where('id', '=', $id)->delete();
            return redirect(route('despesa.index'))->with('success', 'Depesa excluída com sucesso!');
        }catch(\Exception $e){
            return redirect(route('despesa.index'))->withErrors('Ocorreu um erro ao tentar exluir a despesa!');
        }
    }
}
