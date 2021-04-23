<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Optional;
use Illuminate\Support\Facades\Cookie;
use App\Services\GenerateThumbGraphService;
use App\Services\ObtainCurrencyService;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;


class MarketController extends Controller{

    private $clientGeckoCoin;
    private $thumbGraph;
    private $coinCurrencyDefiner;

    public function __construct(GenerateThumbGraphService $thumbGraph, ObtainCurrencyService $coinCurrencyDefiner){
        $this->clientGeckoCoin = new CoinGeckoClient();
        $this->thumbGraph = $thumbGraph;
        $this->coinCurrencyDefiner = $coinCurrencyDefiner;
    }

    public function market(){
        $currency = $this->coinCurrencyDefiner->obtainCurrency();
        $cursymbol = $this->coinCurrencyDefiner->obtainCurrencySymbol($currency);
        //dd($currency);
        $marketvalues = $this->clientGeckoCoin->coins()->getMarkets($currency,['per_page'=>'251','order'=>'market_cap_desc','price_change_percentage'=>'1h,24h,7d','sparkline'=>'true']);
        //dd($marketvalues);
        $parsedCoinId = $this->transformCoinData($marketvalues);
        $this->graphThumbGeneratorCaller($parsedCoinId);
        $date = date('Ymd',time());
        return view ('market',['market' => $marketvalues,'date' => $date, 'curUsed' => $currency, 'symbol' => $cursymbol]);
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

    public function marketPost(Request $request,$locale){
        //dd($_POST['cookie']);
        //dd($request->cookie('selected_currency'));
        //$cookie = $request->cookie('selected_currency');
        //$request->cookie->forget('selected_currency');
        Cookie::queue(Cookie::make('selected_currency',$_POST['cookie'], 43800,'/',null,null,false));
        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }

}





?>