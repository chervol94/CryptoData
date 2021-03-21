<?php



namespace App\Http\Controllers;

use App\Services\GenerateThumbGraphService;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Illuminate\Support\Optional;

class MarketController extends Controller{

    private $clientGeckoCoin;
    private $thumbGraph;

    public function __construct(){
        $this->clientGeckoCoin = new CoinGeckoClient();
        $this->thumbGraph = new GenerateThumbGraphService();
    }

    public function market(){
        $marketvalues = $this->clientGeckoCoin->coins()->getMarkets('usd',['per_page'=>'251','order'=>'market_cap_desc','price_change_percentage'=>'1h,24h,7d','sparkline'=>'true']);
        //dd($marketvalues);
        $parsedCoinId = $this->transformCoinData($marketvalues);
        $graphsArray = $this->graphThumbGeneratorCaller($parsedCoinId);
        return view ('market',['market' => $marketvalues, 'graphs' => $graphsArray]);
    }

    public function graphThumbGeneratorCaller(Array $coinGraphData){
        $this->thumbGraph->setArrayData($coinGraphData);
        $this->thumbGraph->generateGraph();
        return $this->thumbGraph->getGraphData();
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

}





?>