<?php

namespace App\Http\Controllers;
use App\Models\Checkin;
use \Auth;
use Illuminate\Http\Request;
class CheckinController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
        ]]);
    }

    public function register(Request $request){
        try{
            $validator = \Validator::make($request->all(), [
                'placa' => 'required|regex:/[a-zA-Z]{3}[0-9]{4}/i'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => join(" - ", (array) $validator->errors()->all()),
                ], 400);;
            }
            $placa = strtolower($request->input('placa'));
            
            $checkin = Checkin::where('placa', $placa)->whereNull('dataCheckout')->first();
            if(empty($checkin)){
                $checkin = new Checkin();
                $checkin->placa = $request->input('placa');
                $checkin->user_id = \Auth::user()->id;
                $checkin->save();
                return response()->json(['success' => true, 'data' => $checkin], 201);
            }
            else {
                return response()->json(['success' => true, 'data' => $checkin], 202);
            }

            

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Error interno!',
                'error' => [$e->getMessage()]
            ], 500);
        }
    }

    public function update(Request $request, $idCheckin){
        try{
            $validator = \Validator::make($request->all(), [
                'placa' => 'regex:/[a-zA-Z]{3}[0-9]{4}/i',
                'user_id' => 'numeric',
                'dataCheckout' => 'date',
                'valor' => 'numeric',
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => join(" - ", (array) $validator->errors()->all()),
                ], 400);;
            }
            $checkin = Checkin::where('id', $idCheckin)->permissaoEstacionamento()->first();

            if(!empty($checkin) && count($request->all()) > 0){
                $checkin->update($request->all());
                return response()->json(['success' => true, 'data' => $checkin], 200);
            }
            else if(count($request->all()) === 0){
                return response()->json(['success' => true, 'data' => $checkin], 202);
            }
            else {
                return response()->json(['success' => false, 'message' => 'Checkin não localizado'], 400);
            }

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Error interno!',
                'error' => [$e->getMessage()]
            ], 500);
        }
    }

    public function getCheckinsAtivos(Request $request){
        try{
            $checkins = Checkin::permissaoEstacionamento()->whereNull('dataCheckout')->get();
            return response()->json(['success' => true, 'data' => $checkins], 200);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Error interno!',
                'error' => [$e->getMessage()]
            ], 500);
        }
    }
}
