@extends('layouts.master')

@section('title')
    Stacja benzynowa
@endsection

@section('content')

	<h1><i class="fas fa-newspaper"></i> Dziennik wydarzeń </h1>

<<<<<<< HEAD
	<?php $logs = DB::table('logs')->get(); 
=======
<<<<<<< HEAD
	<?php 
/*
        $logs = DB::table('logs')->get(); 
>>>>>>> parent of 5e12fba... Revert "Update 1.4.5 - added depot"
        $test = isset($_GET['test'])?$_GET['test']:'all';
        $from = isset($_GET['date_from'])?$_GET['date_from']:date("0-0-0 0:0:0");
        $to = isset($_GET['date_to'])?$_GET['date_to']:date("Y-m-d H:i:s");
    ?>

  <form action="{{route('logs')}}" method="get">
    <label for="category">Wybierz kategorie: </label>
    <select name="test" class="custom-select">
      <option selected value="all">wszystko</option>
      <option value="employee">pracownik</option>
      <option value="product">produkt</option>
      <option value="login">logowanie</option>
<<<<<<< HEAD
=======
      <option value="invoices">faktura</option>
=======
    <select id="category" name="category" class="myCategory select-s">
      <optgroup label = "Wybierz kategorię">
        <option value="selectAll" selected>Wszystkie kategorie</option>
        <option value="employee">Pracownik</option>
        <option value="login">Login</option>
        <option value="product">Produkt</option> 
      </optgroup>
>>>>>>> 17d82192b00c6af2e5145b83e7856f6e6d14680a
>>>>>>> parent of 5e12fba... Revert "Update 1.4.5 - added depot"
    </select>
 
    <table class="table table-hover">
      <thead class="table-th">
        <tr>
          <th>#</th>
          <th>IP</th>
          <th>Login</th>
          <th>Wiadomość</th>
          <th>Czas</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>


<script>
  $(".myCategory").select2();
</script>

<script type="text/javascript">
  $('#category').on('change',function(){
    $value=$(this).val();
    $.ajax({
      type :  'get',
      url  :  '{{URL::to('searchLog')}}',
      data :  {'category': $value},
      success:function(data){
          $('tbody').html(data);
      }
    });
  })
</script>

<script type="text/javascript">
 
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
</script>


<<<<<<< HEAD
    <input type="date" name="date_from">
    <input type="date" name="date_to">

    <button type="submit" class="btn btn-primary">Filtruj</button>
  </form>

	<table class="table table-hover">
    <thead class="table-th">
      <tr>
        <th scope="col">#</th>
        <th scope="col">IP</th>
        <th scope="col">Login</th>
        <th scope="col">Wiadomość</th>
        <th scope="col">Czas</th>
      </tr>
    </thead>

	@foreach($logs as $i => $data)
  <?php 
        $category = DB::table('logs')->where('id', $i+1)->pluck('category')->first();
        $time=DB::table('logs')->where('id', $i+1)->whereBetween('time', [$from , $to])->pluck('time')->first();
   ?>
   @if(($category==$test or $test=='all') and $time)
    <tbody class="table-bordered">
     <?php $val = DB::table('logs')->where('id', $i+1)->pluck('value')->first(); ?>
      <tr class= "{{$val=='good'?'bggoodlog':'bgbadlog'}}">    
        <td>{{$data->id}}</td>
        <td>{{$data->ip}}</td>
        <td>{{$data->login}}</td>
        <td>{{$data->message}}</td>
        <td>{{$data->time}}</td>  
      </tr>
    </tbody>
    @endif
	@endforeach
	</table>
<<<<<<< HEAD
=======

<script>
  $(".myCategory").select2();
</script>

<script type="text/javascript">
  $('#category').on('change',function(){
    $value=$(this).val();
    $.ajax({
      type :  'get',
      url  :  '{{URL::to('searchLog')}}',
      data :  {'category': $value},
      success:function(data){
          $('tbody').html(data);
      }
    });
  })
</script>

<script type="text/javascript">
 
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
</script>


=======
>>>>>>> 17d82192b00c6af2e5145b83e7856f6e6d14680a
>>>>>>> parent of 5e12fba... Revert "Update 1.4.5 - added depot"
@endsection