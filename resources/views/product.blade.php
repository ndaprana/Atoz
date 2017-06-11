@extends('layout')
    @section('content')
	<!-- Newsletter -->
	<div class="w3lsnewsletter" id="w3lsnewsletter">
		<div class="container">
			<div class="w3lsnewsletter-grids">
				<div class="col-md-5 w3lsnewsletter-grid w3lsnewsletter-grid-1 subscribe">
					<h2>Product Commerce</h2>
				</div>
				<div class="col-md-7 w3lsnewsletter-grid w3lsnewsletter-grid-2 email-form">
					<form method="POST" action="{!! url('/order/product') !!}">
			          {!! csrf_field() !!}
			          @if (count($errors))
			              <ul>
			                  @foreach($errors->all() as $error)
			                      <li>{!! $error !!}</li>
			                  @endforeach
			              </ul>
			          @endif
						<input class="email" type="text" name="product" placeholder="Product" required>
						<input class="email" type="text" name="shipping" placeholder="Shipping Address" required>
						<input class="email" type="text" name="value" placeholder="Price" required>
						@if(isset($user))
						<input type="submit" class="submit" value="SUBMIT">
						@else
						<br><a href="#small-dialog1" class="popup-with-zoom-anim" >SUBMIT</a>
						@endif
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- //Newsletter -->
@stop