@extends('layout.email-layout')
@section('content')
<h6 style="text-align: center;
    font-size: 16px;
        padding: 5px;
    margin: 10px;
    font-weight: 800;">
Akurana Pradeshya Sabha
</h6>
<hr>
<p style="font-size: 16px;
    padding: 5px;
    justify-content: center;
    margin: 5px;">
    {{$data['greatings']}},
    
</p>

<p style="font-size: 16px;
    padding: 5px;
    justify-content: center;
    margin: 5px;">
    {{$data['content']}}
    
</p>

<div style="font-size: 15px;
    padding: 15px;
    justify-content: center;
    color: #666;
    background-color: #e9ecef;">
</div>

<div align="center" style="font-size: 16px;
    padding: 5px;
    justify-content: center;
    margin: 5px;">
    <p>{{$data['footer']}}</p>
</div>

@stop
