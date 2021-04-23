
@extends('layouts.mainlayout')

@section('mainContent')
    
    <h2 class="text-center mt-4 mb-4">{{ __('Top 100 Cryptocurrency By Market Cap') }}</h2>
    <div style="overflow-x: auto">
        <table class="table table-responsive mx-auto" style=" width:80% ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Coin') }}</th>
                <th scope="col">{{ __('Symbol') }}</th>
                <th scope="col">{{ __('Price') }}</th>
                <th scope="col">1h</th>
                <th scope="col">24h</th>
                <th scope="col">7d</th>
                <th scope="col">{{ __('Market Cap.') }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                
                @foreach ($market as $key => $coin)
                    <tr>
                    <th scope="row">{{$coin['market_cap_rank']}}</th>
                        <td>
                            <img src="{{str_replace('large','thumb', $coin['image'])}}"/> 
                            <a  class="link-dark" href="coin/{{$coin['id']}}">{{$coin['name']}}</a>
                        </td>
                        <td>{{strtoupper($coin['symbol'])}}</td>

                        @if (App::getLocale() != 'en')
                            <td>{{number_format($coin['current_price'],2,',','.')}}{{$symbol}}</td>
                        @else
                            <td>{{$symbol}}{{number_format($coin['current_price'],2)}}</td> 
                        @endif

                        @if ($coin['price_change_percentage_1h_in_currency'] <= 0)
                            <td class="text-danger">{{number_format($coin['price_change_percentage_1h_in_currency'],2,'.','')}}%</td>
                        @else
                            <td class="text-success">{{number_format($coin['price_change_percentage_1h_in_currency'],2,'.','')}}%</td>
                        @endif

                        @if ($coin['price_change_percentage_24h'] <= 0)
                            <td class="text-danger">{{number_format($coin['price_change_percentage_24h'],2,'.','')}}%</td>
                        @else
                            <td class="text-success">{{number_format($coin['price_change_percentage_24h'],2,'.','')}}%</td>
                        @endif

                        @if ($coin['price_change_percentage_7d_in_currency'] <= 0)
                            <td class="text-danger">{{number_format($coin['price_change_percentage_7d_in_currency'],2,'.','')}}%</td>
                        @else
                            <td class="text-success">{{number_format($coin['price_change_percentage_7d_in_currency'],2,'.','')}}%</td>
                        @endif

                        @if (App::getLocale() != 'en')
                            <td>{{number_format($coin['market_cap'],0,',','.')}}{{$symbol}}</td>
                        @else
                            <td>{{$symbol}}{{number_format($coin['market_cap'])}}</td>
                        @endif
                            <td><img src="{{asset('storage/graphs/'.$date."_".$coin['id'].'.svg')}}" alt=""></td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
          <!--<tr>
            <th scope="row">1</th>
            <td>$coindata['name']}}</td>
            <td>strtoupper($coindata['symbol'])}}</td>
            <td>$coindata['market_data']['current_price']['eur']}}</td>
          </tr>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Symbol</th>
                <th scope="col">Price</th>
              </tr>
            </thead>
            <tbody>
                <php $count = 1 ?>
                foreach ($market as $coin)
                    <tr>
                    <th scope="row">{$count}}</th>
                    foreach ($coin as $key => $value)
                        if (!is_array($value))
                            <td>{$key}} -> {$value}}</td>
                        endif
                    endforeach
                    <php $count++?>
                    </tr>
                endforeach
            </tbody>
        </table>->
@endsection    
