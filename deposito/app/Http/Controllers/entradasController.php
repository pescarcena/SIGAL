<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entrada;
use App\Insumos_entrada;

class entradasController extends Controller
{   
    private $menssage = [
        'orden.required'    =>  'Especifique un numero de orden de compra',
        'provedor.required' =>  'Seleccione un proveedor', 
        'insumos.required'  =>  'No se han especificado insumos para esta entrada'
    ];

    public function index(){
        return view('entradas/indexEntradas');
    }

    public function viewRegistrar(){  
        return view('entradas/registrarEntrada');
    }

    public function detalles(){
        return view('entradas/detallesEntrada');
    }

    public function allInsumos($type = NULL){
        switch($type){
            
            case 'orden':
                
                return DB::table('insumos_entradas')
                    ->where('insumos_entradas.type', 'orden')
                    ->join('entradas', 'entradas.id', '=', 'insumos_entradas.entrada')
                    ->join('insumos', 'insumos.id' , '=', 'insumos_entradas.insumo')
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),'entradas.codigo as entrada',
                        'entradas.id as entradaId','insumos.codigo',
                        'insumos.descripcion','insumos_entradas.cantidad')
                    ->orderBy('insumos_entradas.id', 'desc')->get();
            break;
            
            case 'donacion':
                
                return DB::table('insumos_entradas')
                    ->where('insumos_entradas.type', 'donacion')
                    ->join('entradas', 'entradas.id', '=', 'insumos_entradas.entrada')
                    ->join('insumos', 'insumos.id' , '=', 'insumos_entradas.insumo')
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),'entradas.codigo as entrada',
                        'entradas.id as entradaId','insumos.codigo',
                        'insumos.descripcion','insumos_entradas.cantidad')
                    ->orderBy('insumos_entradas.id', 'desc')->get();
            break;

            case 'devolucion':
                return DB::table('insumos_entradas')
                    ->where('insumos_entradas.type', 'devolucion')
                    ->join('entradas', 'entradas.id', '=', 'insumos_entradas.entrada')
                    ->join('insumos', 'insumos.id' ,  '=', 'insumos_entradas.insumo')
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),
                        'entradas.codigo as entrada', 'entradas.id as entradaId','insumos.codigo',
                        'insumos.descripcion','insumos_entradas.cantidad')
                    ->orderBy('insumos_entradas.id', 'desc')->get();
            break;

            default:

                $devoluciones = DB::table('insumos_entradas')
                    ->where('insumos_entradas.type', 'devolucion')
                    ->join('entradas', 'entradas.id', '=', 'insumos_entradas.entrada')
                    ->join('insumos', 'insumos.id' , '=', 'insumos_entradas.insumo')
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),
                        'entradas.codigo as entrada', 'insumos_entradas.id', 'entradas.id as entradaId','insumos.codigo',
                        'insumos.descripcion','insumos_entradas.cantidad', 'insumos_entradas.type');
                
                return DB::table('insumos_entradas')
                    ->where('insumos_entradas.type','orden')
                    ->orWhere('insumos_entradas.type','donacion')
                    ->join('entradas', 'entradas.id', '=', 'insumos_entradas.entrada')
                    ->join('insumos', 'insumos.id' , '=', 'insumos_entradas.insumo')
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),
                        'entradas.codigo as entrada', 'insumos_entradas.id', 'entradas.id as entradaId','insumos.codigo',
                        'insumos.descripcion','insumos_entradas.cantidad','insumos_entradas.type')
                    ->unionAll($devoluciones)
                    ->orderBy('id', 'desc')->get();
            break;
        }
    }

    public function allEntradas($type = NULL){

        $deposito = Auth::user()->deposito; 

        switch ($type) {
        
            case 'orden':
                return DB::table('entradas')
                    ->where('type', 'orden')
                    ->where('deposito', $deposito)
                    ->join('provedores', 'entradas.provedor', '=', 'provedores.id')
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),'entradas.codigo',
                        'entradas.orden','provedores.nombre as provedor', 'entradas.id')
                     ->orderBy('entradas.id', 'desc')->get();
            break;

            case 'donacion':
                return DB::table('entradas')
                    ->where('type', 'donacion')
                    ->where('deposito', $deposito)
                    ->join('provedores', 'entradas.provedor', '=', 'provedores.id')
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),
                        'entradas.codigo','provedores.nombre as provedor', 'entradas.id')
                     ->orderBy('entradas.id', 'desc')->get();
            break;

            case 'devolucion':
                return DB::table('entradas')
                    ->where('type', 'devolucion')
                    ->where('deposito', $deposito)
                    ->join('departamentos', 'entradas.provedor', '=', 'departamentos.id')
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),
                        'entradas.codigo','departamentos.nombre as provedor', 'entradas.id')
                     ->orderBy('entradas.id', 'desc')->get();
            break;

            default:

                $devoluciones = DB::table('entradas')
                    ->where('entradas.type', 'devolucion')
                    ->where('entradas.deposito', $deposito)
                    ->join('departamentos', 'entradas.provedor', '=', 'departamentos.id')
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),
                        'entradas.id', 'codigo', 'departamentos.nombre as provedor', 'type');

                return DB::table('entradas')
                    ->where(function ($query) {
                        $query->where('entradas.type', 'orden')
                        ->orWhere('entradas.type', 'donacion');
                    })
                    ->where('entradas.deposito', $deposito)
                    ->join('provedores', 'entradas.provedor', '=', 'provedores.id')
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),
                        'entradas.id', 'codigo', 'provedores.nombre as provedor', 'type')
                    ->unionAll($devoluciones)
                    ->orderBy('id', 'desc')->get(); 
            break;
        }
    }   

    public function getEntrada($id){
        
        
        $entrada = Entrada::where('id',$id)->first();

        if(!$entrada){
            return Response()->json(['status' => 'danger', 'menssage' => 'Esta Entrada no existe']);            
        }
        else{

            if($entrada['type'] == 'devolucion'){
                
                $entrada = DB::table('entradas')->where('entradas.id',$id)
                    ->join('departamentos', 'entradas.provedor', '=', 'departamentos.id')
                    ->join('users', 'entradas.usuario' , '=', 'users.id' )
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),
                        DB::raw('DATE_FORMAT(entradas.created_at, "%H:%i:%s") as hora'), 'entradas.codigo',
                        'entradas.orden', 'departamentos.nombre as provedor', 'users.email as usuario')
                    ->first();

                $insumos = DB::table('insumos_entradas')->where('insumos_entradas.entrada', $id)
                    ->join('insumos', 'insumos_entradas.insumo', '=', 'insumos.id')
                    ->select('insumos.codigo', 'insumos.descripcion', 'insumos_entradas.cantidad')
                    ->get();                 
            }
            else{

                $entrada = DB::table('entradas')->where('entradas.id',$id)
                    ->join('provedores', 'entradas.provedor', '=', 'provedores.id')
                    ->join('users', 'entradas.usuario' , '=', 'users.id' )
                    ->select(DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),
                        DB::raw('DATE_FORMAT(entradas.created_at, "%H:%i:%s") as hora'), 'entradas.codigo',
                        'entradas.orden', 'provedores.nombre as provedor', 'users.email as usuario')
                    ->first();

                $insumos = DB::table('insumos_entradas')->where('insumos_entradas.entrada', $id)
                    ->join('insumos', 'insumos_entradas.insumo', '=', 'insumos.id')
                    ->select('insumos.codigo', 'insumos.descripcion', 'insumos_entradas.cantidad')
                    ->get(); 
            }

            return Response()->json(['status' => 'success', 'entrada' => $entrada , 'insumos' => $insumos]);
        }
    }

    public function getEntradaCodigo($code){

        $entrada = Entrada::where('codigo',$code)->first();

        if(!$entrada){
            return Response()->json(['status' => 'danger', 'menssage' => 'Esta entrada no existe']);            
        }
        else{

           $entrada = DB::table('entradas')->where('entradas.codigo',$code)
                ->join('provedores', 'entradas.provedor', '=', 'provedores.id')
                ->select('entradas.codigo','entradas.orden','entradas.id', 
                    'provedores.nombre as provedor')
                ->first();

           $insumos = DB::table('entradas')->where('entradas.codigo', $code)
                ->join('insumos_entradas', 'entradas.id', '=', 'insumos_entradas.entrada')
                ->join('insumos', 'insumos_entradas.insumo', '=', 'insumos.id')
                ->select('insumos.codigo', 'insumos.descripcion', 'insumos_entradas.cantidad', 'insumos_entradas.id as id')
                ->get();

            return Response()->json(['status' => 'success', 'entrada' => $entrada , 'insumos' => $insumos]);
        }
    }

    public function getOrden($number){

        $entrada = Entrada::where('orden',$number)->first();

        if(!$entrada){
            return Response()->json(['status' => 'danger', 'menssage' => 'Esta Orden no existe']);   
        }
        else{

            $orden = DB::table('entradas')->where('entradas.orden', $number)
                     ->join('provedores', 'entradas.provedor', '=', 'provedores.id')
                     ->select('entradas.orden as numero', 'provedores.nombre as provedor')
                     ->first();  

            $entradas = Entrada::where('entradas.orden',$number)->lists('id');
            
            $insumos  = DB::table('insumos_entradas')->whereIn('entrada', $entradas)
                        ->join('entradas', 'insumos_entradas.entrada', '=', 'entradas.id')
                        ->join('insumos', 'insumos_entradas.insumo', '=', 'insumos.id')
                        ->select('entradas.codigo as entrada','insumos.codigo as codigo',
                            DB::raw('DATE_FORMAT(entradas.created_at, "%d/%m/%Y") as fecha'),
                            'entradas.id as entradaId','insumos.descripcion as descripcion',
                            'insumos_entradas.cantidad as cantidad')
                        ->orderBy('insumos_entradas.id', 'desc')->get();

            return Response()->json(['status' => 'success', 'orden' => $orden, 'insumos' => $insumos]);
            
        }
    }

    public function registrar($type, Request $request){
        
        $data     = $request->all(); 
        $usuario  = Auth::user()->id;
        $deposito = Auth::user()->deposito;   

        switch ($type){

            case 'orden':

                $validator = Validator::make($data,[
                    'orden'   =>  'required',
                    'provedor' =>  'required|equal_provedor:orden',
                    'insumos'  =>  'required|insumos'
                ], $this->menssage);

                if($validator->fails()){
                    return Response()->json(['status' => 'danger', 'menssage' => $validator->errors()->first()]);   
                }
                else{

                    $insumos = $data['insumos'];
                    $code =  'EO'.strtoupper( str_random(6) );

                    $entrada = Entrada::create([
                                'codigo'   => $code,
                                'orden'    => $data['orden'],
                                'provedor' => $data['provedor'],
                                'type'     => 'orden',
                                'usuario'  => $usuario,
                                'deposito' => $deposito
                            ])['id'];

                    foreach ($insumos as $insumo){
                        
                        Insumos_entrada::create([
                            'entrada'   => $entrada,
                            'insumo'    => $insumo['id'],
                            'cantidad'  => $insumo['cantidad'],
                            'type'      => 'orden'
                        ]);

                        inventarioController::almacenaInsumo($insumo['id'], $insumo['cantidad']);
                    }

                    return Response()->json(['status' => 'success', 'menssage' => 
                        'Entrada completada satisfactoriamente', 'codigo' => $code]);
                }
            break;

            case 'donacion':

                $validator = Validator::make($data,[
                    'provedor' =>  'required',
                    'insumos'  =>  'required|insumos'
                ], $this->menssage);

                if($validator->fails()){
                    return Response()->json(['status' => 'danger', 'menssage' => $validator->errors()->first()]);   
                }
                else{

                    $insumos = $data['insumos'];
                    $code =  'ED'.strtoupper( str_random(6) );

                    $donacion = Entrada::create([
                                'codigo'   => $code,
                                'provedor' => $data['provedor'],
                                'type'     => 'donacion',
                                'usuario'  => $usuario,
                                'deposito' => $deposito
                              ])['id'];

                    foreach ($insumos as $insumo) {
                        
                        Insumos_entrada::create([
                            'entrada'   => $donacion,
                            'insumo'    => $insumo['id'],
                            'cantidad'  => $insumo['cantidad'],
                            'type'      => 'donacion'
                        ]);

                        inventarioController::almacenaInsumo($insumo['id'], $insumo['cantidad']);
                    }

                    return Response()->json(['status' => 'success', 'menssage' => 
                        'Entrada completada satisfactoriamente', 'codigo' => $code]);
                }
            break;

            case 'devolucion':

                $validator = Validator::make($data,[
                    'departamento' =>  'required',
                    'insumos'  =>  'required|insumos'
                ], $this->menssage);

                if($validator->fails()){
                    return Response()->json(['status' => 'danger', 'menssage' => $validator->errors()->first()]);   
                }
                else{

                    $insumos = $data['insumos'];
                    $code =  'EV'.strtoupper( str_random(6) );

                    $devolucion = Entrada::create([
                                'codigo'   => $code,
                                'provedor' => $data['departamento'],
                                'type'     => 'devolucion',
                                'usuario'  => $usuario,
                                'deposito' => $deposito
                              ])['id'];

                    foreach ($insumos as $insumo) {
                        
                        Insumos_entrada::create([
                            'entrada'     => $devolucion,
                            'insumo'      => $insumo['id'],
                            'cantidad'    => $insumo['cantidad'],
                            'type'        => 'devolucion'
                        ]);

                        inventarioController::almacenaInsumo($insumo['id'], $insumo['cantidad']);
                    }

                    return Response()->json(['status' => 'success', 'menssage' => 
                        'Entrada completada satisfactoriamente', 'codigo' => $code]);
                }
            break;
        }
    }
}
