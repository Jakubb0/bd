@extends('layouts.master')

@section('title')
    Stacja benzynowa
@endsection

@section('content')
 
	<h1><i class="fas fa-file-alt"></i>Faktury</h1>

  <a href="{{route('addInvoices')}}" class="btn btn-info">Nowa faktura</a>

	<?php $invoices = DB::table('invoices')->get(); ?>

	<table class="table table-hover">
    <thead class="table-th">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nazwa</th>
        <th scope="col">NIP</th>
        <th scope="col">Wartość podatku</th>
      </tr>
    </thead>
	@foreach($invoices as $i => $data)
    <tbody class="table-bordered">
      <tr>    
        <td>{{$data->id}}</td>
        <td>{{$data->name}}</td>
        <td>{{$data->NIP}}</td> 
        <td>{{$data->tax_percent}}%</td>               
      </tr>
    </tbody>
	@endforeach
	</table>
@endsection