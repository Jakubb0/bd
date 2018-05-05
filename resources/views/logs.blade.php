@extends('layouts.master')

@section('title')
    Stacja benzynowa
@endsection

@section('content')

	<h1><i class="fas fa-newspaper"></i> Dziennik wydarzeń </h1>

	<?php 
/*
        $logs = DB::table('logs')->get(); 
        $test = isset($_GET['test'])?$_GET['test']:'all';
        $from = isset($_GET['date_from'])?$_GET['date_from']:date("0-0-0 0:0:0");
        $to = isset($_GET['date_to'])?$_GET['date_to']:date("Y-m-d H:i:s");
*/
    ?>


      <select id="category" name="category" class="myCategory select-s">
        <optgroup label = "Wybierz kategorię">
          <option value="selectAll" selected>Wszystkie kategorie</option>
          <option value="employee">Pracownik</option>
          <option value="login">Login</option>
          <option value="product">Produkt</option> 
        </optgroup>
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


@endsection