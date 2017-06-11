@extends('layout')
    @section('content')
	<!-- Newsletter -->
	<div class="agileheader">
		<div class="container">
			<div class="icon-box col-md-3 col-sm-4">Order No.</div>
			<div class="icon-box col-md-3 col-sm-4">Description</div>
			<div class="icon-box col-md-3 col-sm-4">Total</div>
			<div class="icon-box col-md-3 col-sm-4">Information</div>
		</div>
		<div class="container">
		@foreach ($order as $val)
			<div class="icon-box col-md-3 col-sm-4">{!! $val->id_order !!}</div>
			@if($val->product == 'Prepaid Balance')
			<div class="icon-box col-md-3 col-sm-4">{!! $val->value !!} for {!! $val->shipping !!}</div>
			@else
			<div class="icon-box col-md-3 col-sm-4">{!! $val->product !!} that cost {!! $val->value !!}</div>
			@endif
			<div class="icon-box col-md-3 col-sm-4">{!! $val->price !!}</div>
			@if($val->status == 1 && time() >= strtotime("+5 Minutes", $val->created_date))
			<div class="icon-box col-md-3 col-sm-4"><span class="label label-danger">Canceled</span></div>
			@elseif($val->status == 2)
				@if($val->product == 'Prepaid Balance')
					<div class="icon-box col-md-3 col-sm-4"><span class="label label-success">Success</span></div>
				@else
					<div class="icon-box col-md-3 col-sm-4">Shipping Code : {!! $val->code !!}</div>
				@endif
			@else
			<a href="{!! url('/order/pay/'.$val->id_order) !!}"><div class="icon-box col-md-3 col-sm-4">Pay</div></a>
			@endif
		@endforeach
		<?php echo $order->render(); ?>
		</div>
	</div>
	<!-- //Newsletter -->
@stop