
@extends('layouts.mainlayout')

@section('mainContent')
    @foreach ($data as $coin)
        @foreach ($coin as $key => $price)
            @if ($key == "usd")
                <h1> The price of {{$cryptoid}} is {{$price}}$</h1>
                @else
                <h1> The price of {{$cryptoid}} is {{$price}}₽</h1>
            @endif
        @endforeach
    @endforeach
@endsection