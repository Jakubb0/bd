@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection


@section('content')

<?php $cashboxes = DB::table('cashboxes')->get(); ?>


@foreach($cashboxes as $i=>$data)
@if($data->employee_id == null)
<form action="{{route('useCashbox')}}" method="post">						
		<button class="btn btn-dark btn-lg" name="cashbox_number" type="submit" value="{{$data->id}}">Kasa {{$data->id}}</button>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</div>
</form>	
@endif

@endforeach

@endsection