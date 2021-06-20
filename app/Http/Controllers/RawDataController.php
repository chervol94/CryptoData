<?php

namespace App\Http\Controllers;

//use App\Models\LaravelHelpController;
//use App\Models\

use App\Services\GenerateThumbGraphService;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class RawDataController extends Controller{

//metodos publicos en controladores == rutas
//para llamar a un metodo en el mismo controlador se ejecuta en privado
    private $clientGeckoCoin;

    public function __construct(){
        $this->clientGeckoCoin = new CoinGeckoClient();
    }



    private function basicCall(){
        $data = $this->clientGeckoCoin->coins()->getList();
        //dd($data);
        return $data;
    }

    public function index(){
        $data1 = $this->basicCall();
        //dd($data1);
    return view ('rawdata',['coins' => $data1]);
    }

    public function price($locale,$cryptoid,$cur){
        /*$list = $this->basicCall();
        $coinprices = [];
        $count = 0;
        foreach ($list as $arry){
            foreach ($arry as $key => $data){
                if($key == "id"){
                    echo ($key." ".$data); 
                    $valuemoney = $this->clientGeckoCoin->simple()->getPrice($data, 'usd');
                    array_push($coinprices, $valuemoney);  
                    $count++;
                }
            }
           if($count == 10){
            break;
           } 
        }
        dd($coinprices);*/
        //die($cryptoid);
        $valuemoney = $this->clientGeckoCoin->simple()->getPrice($cryptoid, $cur);
        //dd($valuemoney);
        return view ('price',['cryptoid' => $cryptoid, 'data' => $valuemoney]);
    }

    public function select($locale,$cryptoid){
        return view ('currency',['cryptoid' => $cryptoid]);
    }

    public function homeplaceholder(){
        return view('home');
    }

    
}
    






?>