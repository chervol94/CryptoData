<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;

class ObtainCurrencyService{

    public function obtainCurrency(){
        //dd(Cookie::get('selected_currency');
        if(Cookie::get('selected_currency') !== null){
            return Cookie::get('selected_currency');
        }else{
            return 'usd';
        }
        
    }

    public function obtainCurrencySymbol($currency){
        switch ($currency) {
            case 'usd':
                $symbol = "US$";
            break;
            
            case 'jpy':
                $symbol = "¥";
            break;

            case 'eur':
                $symbol = "€";
            break;

            case 'gpb':
                $symbol = "£";
            break;

            case 'rub':
                $symbol = "₽";
            break;

            case 'cad': 
                $symbol = "CA$";
            break;

            case 'aud':
                $symbol = 'AU$';
            break;

            default:
                $symbol = "N/A";
            break;
        }
        return $symbol;
    }

}


?>