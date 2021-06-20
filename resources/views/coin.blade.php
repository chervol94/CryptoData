@extends('layouts.mainlayout')

@section('mainContent')

<div class="container">
  <div class="my-5 "></div>
  <div class="mt-3">
    <div class="col-12 row p-0 m-0">
      <div class="col-lg-7 col-md-7 tw-flex tw-justify-center flex-md-row align-middle tw-items-center justify-content-md-start p-0 m-0">
        <img src="{{$coindata['image']['small']}}" alt="coin image"/>

        @if (empty($coindata['localization'][$lang]))
          <h1 class="mr-md-3 mx-2 mb-md-0 font-semibold">{{$coindata['localization']['en']}} ({{strtoupper($coindata['symbol'])}})</h1>
        @else
          <h1 class="mr-md-3 mx-2 mb-md-0 font-semibold">{{$coindata['localization'][$lang]}} ({{strtoupper($coindata['symbol'])}})</h1>
        @endif

      </div>
      <div class="col-lg-5 col-md-5 text-center text-md-right mt-md-0 pr-0">
        <div class="text-3xl">
          @if ($lang != 'en')
            <span class="no-wrap">{{__('Price')}}: {{number_format($coindata['market_data']['current_price'][$curr],2,',','.')}}{{$currsymbol}}</span>
          @else
            <span class="no-wrap">{{__('Price')}}: {{$currsymbol}}{{number_format($coindata['market_data']['current_price'][$curr],2)}}</span> 
          @endif

          @if ($coindata['market_data']['price_change_24h']<=0)
            <span class="text-danger text-1xl">{{number_format($coindata['market_data']['price_change_percentage_24h'],2,'.','')}}%</span>
          @else
            <span class="text-success text-1xl">{{number_format($coindata['market_data']['price_change_percentage_24h'],2,'.','')}}%</span>
          @endif
        </div>
        <div class="text-muted text-normal">
          {{number_format($coindata['market_data']['current_price']['btc'], 8)}} BTC 
          @if ($coindata['market_data']['price_change_percentage_24h_in_currency']['btc']<=0)
            <span class="text-danger">{{number_format($coindata['market_data']['price_change_percentage_24h_in_currency']['btc'],2,'.','')}}%</span>
          @else
            <span class="text-success">{{number_format($coindata['market_data']['price_change_percentage_24h_in_currency']['btc'],2,'.','')}}%</span>
          @endif
            <!--<i class="far fa-level-up" data-icon-up-class="fa-level-up" data-icon-down-class="fa-level-down"></i>-->
        </div>
      </div>
    </div>
  </div>
  
    @foreach ($coindata as $key => $value)
    @if (is_array($value))
        <p>{{$key}} -> is_Array</p>
    @else
        <p>{{$key}} -> {{$value}}</p>
    @endif
        
    @endforeach
</div>
@endsection