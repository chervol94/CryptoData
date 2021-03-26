<?php



namespace App\Http\Controllers;

use Illuminate\Support\Optional;
use Illuminate\Support\Facades\Cookie;
use App\Services\GenerateThumbGraphService;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;


class MarketController extends Controller{

    private $clientGeckoCoin;
    private $thumbGraph;

    public function __construct(GenerateThumbGraphService $thumbGraph){
        $this->clientGeckoCoin = new CoinGeckoClient();
        $this->thumbGraph = $thumbGraph;
    }

    public function market(){
        $currency = $this->obtainCurrency();
        $marketvalues = $this->clientGeckoCoin->coins()->getMarkets($currency,['per_page'=>'251','order'=>'market_cap_desc','price_change_percentage'=>'1h,24h,7d','sparkline'=>'true']);
        //dd($marketvalues);
        $parsedCoinId = $this->transformCoinData($marketvalues);
        $this->graphThumbGeneratorCaller($parsedCoinId);
        $date = date('Ymd',time());
        return view ('market',['market' => $marketvalues,'date' => $date]);
    }

    public function graphThumbGeneratorCaller(Array $coinGraphData){
        $this->thumbGraph->setArrayData($coinGraphData);
        $this->thumbGraph->generateGraph();
    }

    public function transformCoinData($coinArray){
        $newCoinArray = [];
        //dd($coinArray);
        for ($i=0; $i < count($coinArray) ; $i++) { 
            //array_push($newCoinArray,$coinArray[$i]['id']);
            $newCoinArray[$coinArray[$i]['id']] = $coinArray[$i]['sparkline_in_7d']['price'];
        }
        //dd($newCoinArray);
        return $newCoinArray;
    }

    public function obtainCurrency(){
        //dd(Cookie::get('selected_currency');
        if(Cookie::get('selected_currency') !== null){
            return Cookie::get('selected_currency');
        }else{
            return 'usd';
        }
        
    }

}





?>