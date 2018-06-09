@extends('layouts.master')

@section('title')
	Stacja Benzynowa
@endsection

@section('content')


<h1><i class="fas fa-file-alt"></i>Historia zamówień</h1>

<?php 
	$orders = DB::Table("orders")->get(); 
?>

<table class="table table-hover">
    <thead class="table-th">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Dostawca</th>
        <th scope="col">Pracownik</th>
      </tr>
    </thead>
	@foreach($orders as $i => $data)
	    <tbody class="table-bordered">
	      <tr class="showproducts" data-value="{{$data->id}}">  
	        <td>{{$data->id}}</td>
	        <td>{{DB::Table("providers")->where("id", $data->providers_id)->pluck("name")->first()}}</td>
	        <td>{{DB::Table("pracownicy")->where("id", $data->pracownicy_id)->pluck("name")->first() . ' ' . DB::Table("pracownicy")->where("id", $data->pracownicy_id)->pluck("surname")->first()}}</td>             
	      </tr>
	    </tbody>
	@endforeach
</table>


<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">

						<div class="card">
								
									<table class="table table-hover">
									    <thead class="table-th">
									      <tr>
									        <th scope="col">Produkt</th>
									        <th scope="col">Cena zakupu</th>
									        <th scope="col">Ilosc</th>
									      </tr>
									    </thead>
									    <tbody id="prod-list">
									    	
									    </tbody>
									</table>
									
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
					</div>

			</div>
		</div>

<script type="text/javascript">

	$('.showproducts').on('click', function(){
		$value=$(this).data('value');
		$.ajax({
			type :  'get',
			url  :  '{{URL::to('ordersAjax')}}',
			data :  {'id': $value},
			success:function(data){
					$('#prod-list').html(data);
					$('#myModal').modal('show');
			}
		});
	})

$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>


@endsection