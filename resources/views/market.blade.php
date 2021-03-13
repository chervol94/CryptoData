
@extends('layouts.mainlayout')

@section('mainContent')
    <h1>{{ __('Cryptocurrency Prices & Details') }}</h1>
    @foreach ($market as $coin)
        <table border=1>
        @foreach ($coin as $key => $value)
            @if (!is_array($value)) 
                @if($key == 'image')
                <tr><td>{{$key}}</td><td><img src="{{$value}}"></td></tr>
                @else
                <tr><td>{{$key}}</td><td>{{$value}}</td></tr>
                @endif
            
                
            @endif
        @endforeach
        </table>
        <br>
    
    @endforeach
@endsection    
