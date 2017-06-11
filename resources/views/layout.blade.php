<!DOCTYPE html>
<html>

	@include('global/head')

	<!-- Body -->
	<body>

	<!-- Header -->
	<div class="agileheader" id="agileitshome">

		@include('global/menu')

	</div>
	<!-- //Header -->

	@yield('content')

	@include('global/foot')

	</body>
	<!-- //Body -->

</html>
