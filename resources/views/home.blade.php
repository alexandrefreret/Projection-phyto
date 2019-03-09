@extends('layouts.app')

@section('content')

<section class="section-green">
	<div class="container">
		<h2>Actualités</h2>
		{{-- https://codepen.io/andytran/pen/BNjymy --}}
		<div class="card-deck">
			<div class="card">
				<a href="fr/nos-actualites//actualites/meilleurs-voeux,20.html"><img class="card-img-top" src="theme/img/placeholder/actualites.jpg" alt=""></a>
				<span class="date">07/01/2019</span>
				<div class="card-body">
					<h4>Meilleurs voeux !</h4>
					<p></p>
				</div>
				<div class="card-footer">
					<a class="actu-lire-plus" href="fr/nos-actualites/actualites/meilleurs-voeux,20.html" title="Lire la suite">Lire la suite <i class="far fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>


		<div class="post-module">
		      <!-- Thumbnail-->
		      <div class="thumbnail">
		        <div class="date">
		          <div class="day">27</div>
		          <div class="month">Mar</div>
		        </div><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/photo-1429043794791-eb8f26f44081.jpeg"/>
		      </div>
		      <!-- Post Content-->
		      <div class="post-content">
		        <div class="category">Photos</div>
		        <h1 class="title">City Lights in New York</h1>
		        <h2 class="sub_title">The city that never sleeps.</h2>
		        <p class="description">New York, the largest city in the U.S., is an architectural marvel with plenty of historic monuments, magnificent buildings and countless dazzling skyscrapers.</p>
		        <div class="post-meta"><span class="timestamp"><i class="fa fa-clock-">o</i> 6 mins ago</span><span class="comments"><i class="fa fa-comments"></i><a href="#"> 39 comments</a></span></div>
		      </div>
		    </div>
	</div>
</section>
<div class="separator"></div>

{{-- <div class="elementor-shape">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 60" preserveAspectRatio="none">
		<path class="elementor-shape-fill-green" d="m0,3.54l0,-3.54l1000,0l0,59l-1000,-55.46z"></path>
	</svg>
</div>
<div class="elementor-shape elementor-shape-invert">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 60" preserveAspectRatio="none">
		<path class="elementor-shape-fill-black" d="m0,3.54l0,-3.54l1000,0l0,59l-1000,-55.46z"></path>
	</svg>
</div> --}}

<section class="section-black">
	<div class="container">
		<h2>Prestations</h2>
	</div>
</section>

@endsection
