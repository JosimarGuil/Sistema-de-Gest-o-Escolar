<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siculo;
use App\Models\Curso;
use App\Models\Clace;
use App\Models\Sala;
use App\Models\Turma;
use App\Models\User;
use App\Models\Funcionario;
use App\Models\Aluno;
use App\Models\Pagamento;
use App\Models\TipoPagamento;
use App\Http\Requests\TipoPagamentos;
use App\Models\Mese;
class PagamentosController extends Controller
{
    

    public function index(){
        $classes=Clace::all();
        $tipos=TipoPagamento::with('clace')->get();
        $alunos=Aluno::orderBy('nome','asc')->get();
        $funcionarios=Funcionario::all();
        $meses=Mese::all();

        $entrada1=Pagamento::where('aluno_id','!=',null)->orWhere('outro','!=',NULL)->get()->toArray();

        $saidas1=Pagamento::where('aluno_id',null)->where('outro',null)->get()->toArray();

        $pamentosEntradas=Pagamento::with(['aluno','meses','tipo_pagamento'])
        ->where('aluno_id','>',0)->orWhere('outro','!=',NULL)->orderBy('id','desc')->get();

        $pamentosSaidas=Pagamento::with(['aluno','meses','tipo_pagamento','funcionario'])
        ->where('aluno_id',null)->where('outro',null)->orderBy('id','desc')->get();

        $entradas= array_filter($entrada1,function($item){
            if(date('m',strtotime($item['created_at'])) == date('m')) {
                return true; } else{ return false;  }
        });

        $saidas= array_filter($saidas1,function($item){
            if(date('m',strtotime($item['created_at'])) == date('m')) {
                return true; } else{ return false;  }
        });

        $totalEntradas=0;
        foreach ($entradas as $value) {$totalEntradas += $value['total'];}

        $totalSaidas=0;
        foreach ($saidas as $value) {$totalSaidas += $value['total'];}

        $total1=Pagamento::where('aluno_id','!=',null)->Orwhere('outro','!=',NULL)->get();
        $total=0;
        $saidas2=Pagamento::where('aluno_id',null)->where('outro',NULL)->get();
        $sub=0;
        foreach ($saidas2 as $value) {$sub += $value->total;}
        foreach ($total1 as $value) {$total += $value->total;}
        $totalMes=($totalEntradas - $totalSaidas);
        if(auth()->user()->status==true){

            if((auth()->user()->perfil=='SEO' OR 
            auth()->user()->perfil=='Dir Administrativo' OR auth()->user()->perfil=='Dir Geral' OR 
            auth()->user()->perfil=='Secretário Financeiro' OR 
            auth()->user()->perfil=='Financeiro')){
        return view('painel.pagamentos',compact([
            'tipos','classes','funcionarios','alunos',
           'meses','totalEntradas','pamentosEntradas',
            'total',
            'totalSaidas',
            'sub','totalMes','pamentosSaidas'
        ]));

    }else {
        return redirect()->back();
    }
        
}else {
        
    Auth::logout();

    return redirect()->route('login')->with('sms','Usuário Desativado!');
    
        }
    }


    public function addTipoPagamento(TipoPagamentos $request){
            
        $tipo=TipoPagamento::where('tipo',$request->tipo)->
        where('clace_id',$request->clace_id)->first()?? false;
        if ($tipo==false) { 
            TipoPagamento::create([
                'tipo'=>$request->tipo,
                'clace_id'=>$request->clace_id,
                'preco'=>$request->preco
            ]);
            return redirect()->back()
            ->with('sms1','Tipo de pagamento inserido com sucesso!');
           
        }else{
            return redirect()->back()
            ->with('warning','Já existe esse tipo de pagamento para esta classe!');
        }
    }

    public function deleteTipoPagamentos($id){
        if (is_numeric($id)) {
            TipoPagamento::find($id)->delete();
            return redirect()->back()->with('warning','Tipo de pagamento movido para Lixeira!');
          }else{
           return redirect()->back();
          }
    }


    public function editTipoPagamentos(TipoPagamentos $request,$id){
      
            TipoPagamento::find($id)->update([
                'tipo'=>$request->tipo,
                'clace_id'=>$request->clace_id,
                'preco'=>$request->preco
            ]);
            return redirect()->back()
            ->with('sms3','Tipo de pagamento editado com sucesso!');
        
    }


   public function addPagamento( Request $request){

        $tipo=TipoPagamento::find($request->tipo_pagamento_id)??false; 
        $aluno=Aluno::find($request->aluno_id)?? false;
        
        if($tipo != false and $aluno != false)
        {
            $request->validate([
                'aluno_id'=>['required'],
                'tipo_pagamento_id'=>['required'],
             ]);
             
           if($tipo->clace_id == $aluno->clace_id)
           {
            if(($tipo->tipo=="Propina" or $tipo->tipo=="propina")){
            // pagamento de propinas
            if (isset($request->meses) and $request->meses!=null ) {
                $pagamento= Pagamento::create([
                    'tipo_pagamento_id'=>$request->tipo_pagamento_id,
                    'aluno_id'=>$request->aluno_id,
                    'total'=>( $tipo->preco * count($request->meses) )
                ]);
                $pagamento->meses()->sync($request->meses);
                return redirect()->back()->with('sms1','Pagamento efectuado com sucesso!');         
            }else{
             return redirect()->back()->with('warning','Para se inserir propinas é necessário selecionar os meses a pagar!');
            }
           
            }elseif(($tipo->tipo !="Propina" or $tipo->tipo !="propina")){
                // pagamentos do aluno sem propina
                $pagamento= Pagamento::create([
                    'tipo_pagamento_id'=>$request->tipo_pagamento_id,
                    'aluno_id'=>$request->aluno_id,
                    'total'=>isset($request->qnt)? $tipo->preco * $request->qnt: $tipo->preco,
                    'qnt'=>$request->qnt,
                    'outro'=>$request->outro
                ]);
    
                $pagamento->meses()->sync($request->meses);
                return redirect()->back()->with('sms1','Pagamento efectuado com sucesso!');
            }
           
            
        }else{
            return redirect()->back()->with('warning','A classe do aluno selecionado
            seve ser compatível com a classe do tipo de pagamento!');
        }
     }else {
    
        $request->validate([
            'preco'=>['required'],
             'outro'=>['required']
        ]);
        $pagamento= Pagamento::create([
            'total'=>isset($request->qnt)? $request->preco * $request->qnt: $request->preco,
            'qnt'=>$request->qnt,
            'outro'=>$request->outro
        ]);
    
        $pagamento->meses()->sync($request->meses);
        return redirect()->back()->with('sms1','Pagamento efectuado com sucesso!');
   }
}


   public function editPagamento(Request $request,$id){

    $tipo=TipoPagamento::find($request->tipo_pagamento_id); 
    $aluno=Aluno::find($request->aluno_id);
    $paga=Pagamento::find($id);


    if($tipo != false and $aluno != false){
        $request->validate([
            'aluno_id'=>['required'],
            'tipo_pagamento_id'=>['required'],
         ]);
         
       if($tipo->clace_id==$aluno->clace_id){
        if(($tipo->tipo=="Propina" or $tipo->tipo=="propina")){
        // pagamento de propinas
        if (isset($request->meses) and $request->meses!=null ) {
            $paga->update([
                'tipo_pagamento_id'=>$request->tipo_pagamento_id??$paga->tipo_pagamento_id,
                'aluno_id'=>$request->aluno_id??$paga->aluno_id,
                'total'=>( $tipo->preco * count($request->meses))??$paga->total
            ]);
            $paga->meses()->sync($request->meses);
            return redirect()->back()->with('sms1','Pagamento efectuado com sucesso!');         
        }else{
         return redirect()->back()->with('warning','Para se inserir propinas é necessário selecionar os meses a pagar!');
        }
       
        }elseif(($tipo->tipo !="Propina" or $tipo->tipo !="propina")){
            // pagamentos do aluno sem propina
            $paga->update([
                'tipo_pagamento_id'=>$request->tipo_pagamento_id ?? $paga->tipo_pagamento_id,
                'aluno_id'=>$request->aluno_id ?? $paga->aluno_id,
                'total'=>isset($request->qnt)? $tipo->preco * $request->qnt: $tipo->preco ?? $paga->total,
                'qnt'=>$request->qnt ?? $paga->qnt,
                'outro'=>$request->outro ?? $paga->outro
            ]);

            $paga->meses()->sync($request->meses);
            return redirect()->back()->with('sms1','Pagamento efectuado com sucesso!');
        }
       
        
    }else{
        return redirect()->back()->with('warning','A classe do aluno selecionado
        seve ser compatível com a classe do tipo de pagamento!');
    }
 }else {

    $request->validate([
        'preco'=>['required'],
         'outro'=>['required']
    ]);
    $paga->update([
        'total'=>isset($request->qnt)? $request->preco * $request->qnt: $request->preco,
        'qnt'=>$request->qnt ?? $paga->qnt,
        'outro'=>$request->outro ?? $paga->outro
    ]);

    $paga->meses()->sync($request->meses);
    return redirect()->back()->with('sms3','Pagamento efectuado com sucesso!');
}

    //////////////////////////
   
}


public function DeleteEntradas($id){
    if (is_numeric($id)) {
        Pagamento::find($id)->delete();
        return redirect()->back()->with('sms2','Pagamento movido para lixeira!');
      }else{
       return redirect()->back();
      }
}




public function addSaida(Request $request) {
    
    $saldo= Pagamento::where('aluno_id',"!=",null)->get();
     
    $actual=0;
    foreach($saldo as $item){
        $actual +=$item->total;
    }

     if($request->tipo =="Salário" or $request->tipo =="salário" or
     $request->tipo =="Salario" or $request->tipo =="salario"  and
     $request->filled('meses')){

        $func=Funcionario::find($request->funcionario_id);
        $request->validate([
            'tipo'=>['required'],
            'funcionario_id'=>['required'],
            'meses'=>['required']
         ]);
     
         if (($actual > $func->salario)){
                Pagamento::create([
                    'funcionario_id'=>$request->funcionario_id,
                    'tipo'=>$request->tipo,
                    'desci'=>$request->descri,
                    'total'=> $func->salario * count($request->meses)
                ]); 
                return redirect()->back()->with('sms1','Saída de valor efectuado com sucesso!');    

         }else {
            return redirect()->back()->with('sms2','O saldo é insuficiente para efectuar a saída de Valor!');
         }
        
        }elseif($request->tipo !='Salário' or $request->tipo !='salário'
        or    $request->tipo !="Salario" or $request->tipo !="salario" ){  

            $request->validate([
                'tipo'=>['required'],
                'descri'=>['required'],
                'preco'=>['required']
             ]);
             $valor=isset($request->qnt) ? $request->preco * $request->qnt : $request->preco;
             if ($actual > $valor) {          
            Pagamento::create([
                'tipo'=>$request->tipo,
                'desci'=>$request->descri,
                'total'=> isset($request->qnt)? 
                $request->preco * $request->qnt : $request->preco,
                'qnt'=>$request->qnt,
                'funcionario_id'=>is_numeric($request->funcionario_id) ? $request->funcionario_id : NULL 
            ]);     

            return redirect()->back()->with('sms1','Saída de valor efectuado com sucesso!');
        }else {
            return redirect()->back()->with('sms2','O saldo é insuficiente para efectuar a saída de Valor!');
         }
        }else{
      return redirect()->back()->with('sms2','Para efectuar o pagamento de salário é necessário 
      selecionar os meses e o funcionário');
     }
}
}
