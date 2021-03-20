@extends('layouts.mainlayout')

@section('mainContent')
    <h1>Test</h1>
    @foreach ($coindata as $key => $value)
    @if (is_array($value))
        <p>{{$key}} -> is_Array</p>
    @else
        <p>{{$key}} -> {{$value}}</p>
    @endif
        
    @endforeach
    <p>LLAMO A: {{$coindata['id']}}
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
              <tr>
                <th scope="row">1</th>
                <td>{{$coindata['name']}}</td>
                <td>{{strtoupper($coindata['symbol'])}}</td>
                <td>{{$coindata['market_data']['current_price']['eur']}}</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td></td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
@endsection