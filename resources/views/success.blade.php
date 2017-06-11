@extends('layout')
    @section('content')
	<!-- Newsletter -->
	<div class="w3lsnewsletter" id="w3lsnewsletter">
		<div class="container">
			<div class="w3lsnewsletter-grids">
				<div class="col-md-5 w3lsnewsletter-grid w3lsnewsletter-grid-1 subscribe">
					@if(isset($message))
						<h2>{!! $message !!}</h2>
					@else
						<h2>Order Success</h2>
					@endif
				</div>
				@if(!isset($message))
				<div class="col-md-7 w3lsnewsletter-grid w3lsnewsletter-grid-1 email-form">
					<h2>Your Order Number <br>{!! $order->id_order !!} <br><br>Total <br>{!! $order->price !!} </h2>
					@if($order->product == 'Prepaid Balance')
						<br><h2>Your Mobile Phone Number {!! $order->shipping !!} will be topped up for {!! $order->value !!} after you pay.</h2>
					@else
						<br><h2>{!! $order->product !!} that cost {!! $order->value !!} will be shipped to {!! $order->shipping !!} after you pay.</h2>
					@endif
					@if($order->status == 1 && time() >= strtotime("+5 Minutes", $order->created_date))
						<center><br><br><span class="label label-danger" style="font-size: 150% !important">Canceled</span></center>
					@else
						<center><br><br><a href="{!! url('/order/pay/'.$order->id_order) !!}" ><span class="label label-primary" style="font-size: 150% !important">Pay Here</span></a></center>
					@endif
				</div>
				@endif
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- //Newsletter -->
@stop