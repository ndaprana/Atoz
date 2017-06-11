	<!-- Navigation -->
		<nav class="navbar navbar-default w3ls navbar-fixed-top">
			<div class="container">
				<div class="navbar-header wthree nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand agileinfo" href="{!! url('/') !!}"><span>Atoz</span>.com</a> 
					<ul class="w3header-cart">
						<li class="wthreecartaits"><span class="my-cart-icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i><span class="badge badge-notify my-cart-badge"></span></span></li>
					</ul>
				</div>
				<div id="bs-megadropdown-tabs" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="{!! url('/prepaid-balance') !!}"><span> Prepaid Balance </span></a>
						</li>

						<li class="dropdown">
							<a href="{!! url('/product') !!}"><span> Product Commerce  </span></a>
						</li>
						<li><a href="{!! url('/payment') !!}">PAYMENT</a></li>
						<li class="wthreesearch" style="margin-right: 15px;">
							<form action="{!! url('/order/search') !!}" method="post">
					          {!! csrf_field() !!}
								Order Number :
								<input type="search" name="order" placeholder="Order Number" >
								<button type="submit" class="btn btn-default search" aria-label="Left Align">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
						</li>
						<li class="wthreecartaits wthreecartaits2 cart cart box_1"> 
								<a href="{!! url('/order') !!}"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a>
							</form>   
						</li>
					</ul>
				</div>

			</div>
		</nav>
		<!-- //Navigation -->



		<!-- Header-Top-Bar-(Hidden) -->
		<div class="agileheader-topbar">
			<div class="container">
				<div class="col-md-6 agileheader-topbar-grid agileheader-topbar-grid1">
				</div>
				<div class="col-md-6 agileheader-topbar-grid agileheader-topbar-grid2">
					<ul>
						@if(isset($user))
						<li>Welcome {!! $user->name !!}, <a href="{!! url('auth/logout') !!}">Logout</a></li>
						@else
						<li><a class="popup-with-zoom-anim" href="#small-dialog1">Login</a></li>
						<li><a class="popup-with-zoom-anim" href="#small-dialog2">Sign Up</a></li>
						@endif
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>

				<!-- Popup-Box -->
				<div id="popup1">
					<div id="small-dialog1" class="mfp-hide agileinfo">
						<div class="pop_up">
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
					<div id="small-dialog2" class="mfp-hide agileinfo">
						<div class="pop_up">
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
				<!-- //Popup-Box -->

		</div>
		<!-- //Header-Top-Bar-(Hidden) -->