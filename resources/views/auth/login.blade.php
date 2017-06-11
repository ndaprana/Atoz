@extends('layout')
    @section('content')
	<!-- Newsletter -->
	<div class="agileheader">
		<div class="container">
			<div class="col-md-5">
				<form method="POST" action="{!! url('/auth/login') !!}">
		          {!! csrf_field() !!}
		          @if (count($errors))
		              <ul>
		                  @foreach($errors->all() as $error)
		                      <li>{!! $error !!}</li>
		                  @endforeach
		              </ul>
		          @endif
					<h3>LOGIN</h3>
					<input type="text" placeholder="Email" name="email" value="{!! old('email') !!}" required>
					<input type="password" placeholder="Password" name="password" id="password" required>
					<div class="send-button wthree agileits">
						<input type="submit" value="LOGIN">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- //Newsletter -->
@stop