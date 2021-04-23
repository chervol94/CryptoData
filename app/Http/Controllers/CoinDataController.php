<?php

namespace App\Http\Controllers;

use App\Services\ObtainCurrencyService;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class CoinDataController extends Controller
{
    private $clientGeckoCoin;
    private $coinCurrencyDefiner;
    public function __construct(ObtainCurrencyService $coinCurrencyDefiner){
        $this->clientGeckoCoin = new CoinGeckoClient();
        $this->coinCurrencyDefiner = $coinCurrencyDefiner;
    }

    public function obtainCoinData($lang,$coin){
       
        $result = $this->clientGeckoCoin->coins()->getCoin($coin, ['tickers' => 'false', 'market_data' => 'true','sparkline' => 'true']);
        //dd($result);
        $currency = $this->coinCurrencyDefiner->obtainCurrency();
        $cursymbol = $this->coinCurrencyDefiner->obtainCurrencySymbol($currency);
        return view('coin',[ 'coindata' => $result , 'lang' => $lang, 'curr' => $currency, 'currsymbol' => $cursymbol ]);
    }


    public function coinPost(Request $request,$locale){
        //dd($_POST['cookie']);
        //dd($request->cookie('selected_currency'));
        //$cookie = $request->cookie('selected_currency');
        //$request->cookie->forget('selected_currency');
        Cookie::queue(Cookie::make('selected_currency',$_POST['cookie'], 43800,'/',null,null,false));
        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }
}
