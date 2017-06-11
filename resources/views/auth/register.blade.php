@extends('layout')
    @section('content')
	<!-- Newsletter -->
	<div class="agileheader">
		<div class="container">
			<div class="col-md-5">
				<form method="POST" action="{!! url('/auth/register') !!}">
		        {!! csrf_field() !!}
		        @if (count($errors))
		            <ul>
		                @foreach($errors->all() as $error)
		                    <li>{!! $error !!}</li>
		                @endforeach
		            </ul>
		        @endif
					<h3>SIGN UP</h3>
					<input type="text" Name="name" placeholder="Name" value="{!! old('name') !!}" required>
					<input type="text" Name="email" placeholder="Email" value="{!! old('email') !!}" required>
					<input type="password" Name="password" placeholder="Password" required>
					<input type="password" placeholder="Retype password" name="password_confirmation" required>
					<div class="send-button wthree agileits">
						<input type="submit" value="SIGN UP">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- //Newsletter -->
@stop