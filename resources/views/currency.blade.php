@extends('layouts.mainlayout')

@section('mainContent')
<h1>Select the currency in which you wish to view the price</h1>
<a href="/coin/{{$id}}/usd"><h2>USD</h2></a>
<a href="/coin/{{$id}}/rub"><h2>RUB</h2></a>
@endsection