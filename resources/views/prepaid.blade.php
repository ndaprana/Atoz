@extends('layout')
    @section('content')
	<!-- Newsletter -->
	<div class="w3lsnewsletter" id="w3lsnewsletter">
		<div class="container">
			<div class="w3lsnewsletter-grids">
				<div class="col-md-5 w3lsnewsletter-grid w3lsnewsletter-grid-1 subscribe">
					<h2>Prepaid Balance</h2>
				</div>
				<div class="col-md-7 w3lsnewsletter-grid w3lsnewsletter-grid-2 email-form">
					<form method="POST" action="{!! url('/order/prepaid-balance') !!}">
			          {!! csrf_field() !!}
			          @if (count($errors))
			                  @foreach($errors->all() as $error)
			                      {!! $error !!}
			                  @endforeach
			          @endif
						<input class="email" type="text" name="phone" placeholder="Mobile Phone Number" required>
						<select class="value" name="value">
						  <option value="" required>Select Value</option>
						  <option value="10000" required>10000</option>
						  <option value="50000" required>50000</option>
						  <option value="100000" required>100000</option>
						</select>
						@if(isset($user))
						<br><input type="submit" class="submit" value="SUBMIT">
						@else
						<br><br><a href="#small-dialog1" class="popup-with-zoom-anim" >SUBMIT</a>
						@endif
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- //Newsletter -->
@stop