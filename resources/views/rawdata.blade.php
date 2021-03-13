@extends('layouts.mainlayout')

@section('mainContent')
    <!--<a href="/market">
    <button>Go to Market Cap</button>
    </a>-->
    <table border=1>
    @foreach ($coins as $coin)
        <tr>
        @foreach ($coin as $key => $value)
            @if($key != 'id')
                <td>{{$key}}    -   {{$value}}</td>
                @else
                <td><a href="coin/{{$value}}">GO TO PRICE</a></td>
            @endif
        @endforeach
        <tr>
    @endforeach
    </table>
@endsection    
