<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
	<div id="app">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/home') }}">
						{{ config('app.name', 'Laravel') }}
					</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">
						&nbsp;
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (Auth::guest())
							<li><a href="{{ route('login') }}">Admin Login</a></li>
						@elseif(Auth::user())
							<li><a href="{{ route('manage-movies') }}">Manage Movies</a></li>
							<li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
		<div class="content">
			@yield('content')
		</div>

		<div id="loader" style="display: none;">
			<div class="loaderBackground"></div>
			<img src="{{ URL::asset('images/ajax-loader.gif')}}"/>
		</div>

	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript">

		function viewLoader(){
			$("#loader").show();
		}

		function hideLoader(){
			$("#loader").hide();
		}

		$(document).on('change','.genreFilter',function(){
			
			var genreList = [];

			$('input[name="genre"]:checked').each(function () {
				genreList.push($(this).val());
			});

			viewLoader();

			var data = JSON.stringify({ "GenreList" : genreList });

			$.ajax({
				data: data,
				method: 'post',
				url: '{{route("movies.filter.genre")}}',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-Token': '{{ csrf_token() }}'
				},
				success: function (response) {
					if (response.status_code == 200) {
						movieComponent(response.data);
						$("#moviesCount").html(response.data.length);
					}else {
						alert("some error occured");
					}

				}
			});

			$("#loader").hide();

		});

		$(document).on('change','#sortFilter',function(){

			viewLoader();

			var data = JSON.stringify({ "SortValue" : $("#sortFilter").val() });

			$.ajax({
				data: data,
				method: 'post',
				url: '{{route("movies.filter.sort")}}',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-Token': '{{ csrf_token() }}'
				},
				success: function (response) {
					if (response.status_code == 200) {
						movieComponent(response.data);
						$("#moviesCount").html(response.data.length);
					}else {
						alert("some error occured");
					}

				}
			});

			$("#loader").hide();

		});

		/*$(document).on('change','#sortFilter',function(){

			viewLoader();

			var data = JSON.stringify({ "SortValue" : $("#sortFilter").val() });

			$.ajax({
				data: data,
				method: 'post',
				url: '{{route("movies.filter.sort")}}',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-Token': '{{ csrf_token() }}'
				},
				success: function (response) {
					if (response.status_code == 200) {
						movieComponent(response.data);
						$("#moviesCount").html(response.data.length);
					}else {
						alert("some error occured");
					}

				}
			});

			$("#loader").hide();

		});*/

		$('#search_keyword').keyup(function(){
			viewLoader();
			var data = JSON.stringify({ "SearchKeyword" : $('#search_keyword').val() });
			$.ajax({
				data: data,
				method: 'post',
				url: '{{route("movies.filter.search")}}',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-Token': '{{ csrf_token() }}'
				},
				success: function (response) {
					if (response.status_code == 200) {
						movieComponent(response.data);
						$("#moviesCount").html(response.data.length);
					}else {
						alert("some error occured");
					}

				}
			});

			$("#loader").hide();
		});	

		function movieComponent(movies){

			$(".movieComponent").html('');
			var html = "";
			$.each(movies,function(i,data) {
				html += '<div class="col-md-6">';
					html += '<div class="movie">';
						html += '<h2>'+data.name+'</h2>';
						html += '<hr/>';
						html += '<p>'+data.director+'</p>';
						html += '<p>'+data.genre.join(',')+'</p>';
						html += "<p class='inlineBlock' style='margin-right: 2em'><label>Popularity: </label>"+data['99popularity']+"</p>";
						html += '<p class="inlineBlock"><label>Score: </label>'+data.imdb_score+'</p>';
					html += '</div>';
				html += '</div>';
			});

			$(".movieComponent").html(html);
		}	

	    $(document).ready(function() {
	        $('#example').DataTable();
	    });

	</script>
</body>
</html>
