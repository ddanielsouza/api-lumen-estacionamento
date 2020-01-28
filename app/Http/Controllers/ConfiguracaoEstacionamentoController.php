<?php

namespace App\Http\Controllers;
use App\Models\ConfiguracaoEstacionamento;
use \Auth;
use Illuminate\Http\Request;
class ConfiguracaoEstacionamentoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    public function register(Request $request){
        try{
            $validator = \Validator::make($request->all(), [
                'valorHora' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => join(" - ", (array) $validator->errors()->all()),
                ], 400);;
            }
            $placa = strtolower($request->input('placa'));
            
            $config = ConfiguracaoEstacionamento::where('estacionamento_id', \Auth::user()->estacionamento_id)->first();
            if(empty($config)){
                $config = new ConfiguracaoEstacionamento();
                $config->valorHora = $request->input('valorHora');
                $config->estacionamento_id = \Auth::user()->estacionamento_id;
                $config->save();
                return response()->json(['success' => true, 'data' => $config], 201);
            }
            else {
                return response()->json(['success' => true, 'data' => $config], 202);
            }

            

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Error interno!',
                'error' => [$e->getMessage()]
            ], 500);
        }
    }

    public function update(Request $request, $idConfiguracao){
        try{
            $validator = \Validator::make($request->all(), [
                'valorHora' => 'numeric',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => join(" - ", (array) $validator->errors()->all()),
                ], 400);;
            }
            $placa = strtolower($request->input('placa'));
            
            $config = ConfiguracaoEstacionamento::where('id', $idConfiguracao)->permissaoEstacionamento()->first();

            if(!empty($config) && count($request->all()) > 0){
                $config->update($request->all());
                return response()->json(['success' => true, 'data' => $config], 200);
            }
            else if(count($request->all()) === 0){
                return response()->json(['success' => true, 'data' => $config], 202);
            }
            else {
                return response()->json(['success' => false, 'message' => 'Configuração não localizado'], 400);
            }

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Error interno!',
                'error' => [$e->getMessage()]
            ], 500);
        }
    }
}
