<?php

namespace App\Http\Controllers;

//use App\Models\LaravelHelpController;
//use App\Models\
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
        return $data;
    }

    public function index(){
        $data1 = $this->basicCall();
        //$client2 = new CoinGeckoClient();
        //dd($client2->simple()->getPrice('bitcoin', 'usd'));
    return view ('rawdata',['coins' => $data1]);
    }

    public function price($id,$cur){
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
        $valuemoney = $this->clientGeckoCoin->simple()->getPrice($id, $cur);
        //dd($valuemoney);
        return view ('price',['id' => $id, 'data' => $valuemoney]);
    }

    public function select($id){
        return view ('currency',['id' => $id]);
    }

    public function market(){
        $marketvalues = $this->clientGeckoCoin->coins()->getMarkets('usd');
        return view ('market',['market' => $marketvalues]);
    }

    
}
    






?>