
<?php
include 'header.php';


$title='HomePage';
 
?>
		<div id="content" class="container">
			<div class="row margin-top-30">
				<div class="col-md-12 text-center">
					<h2 class"text-center">Your BMW deserves the best</h2>
				</div>
			</div>
			<div class="row margin-top-10">
				<!-- Carousel Slideshow -->
				<div id="carousel-example" class="carousel slide" data-ride="carousel">
					<!-- Carousel Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example" data-slide-to="1"></li>
						<li data-target="#carousel-example" data-slide-to="2"></li>
					</ol>
					<!-- End Carousel Indicators -->
					<!-- Carousel Images -->
					<div class="carousel-inner">
						<div class="item active">
							<img src="assets/img/a.jpg">
						</div>
						<div class="item">
							<img src="assets/img/b.jpg">
						</div>
						<div class="item">
							<img src="assets/img/c.jpg">
						</div>
					</div>
					<!-- End Carousel Images -->

				</div>
				<!-- End Carousel Slideshow -->
			</div>
			<div class="row margin-vert-30">
				<!-- Side Column -->
				<div class="col-md-3">
					<h3 class="margin-bottom-10">Select by Category</h3>
					<ul class="menu">
						<li>
							<a class="fa-angle-right" href="#" >Transmission</a>
						</li>
						<li>
							<a class="fa-angle-right" href="#" >Brake</a>
						</li>
						<li>
							<a class="fa-angle-right" href="#" >Auto Body Parts</a>
						</li>
						<li>
							<a class="fa-angle-right" href="#" >Tires</a>
						</li>
					</ul>
				</div>
				<!-- End Side Column -->
				<!-- Main Text -->
				<div class="col-md-9">
					<h2>Nulla in enim quis</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nec suscipit magna. Suspendisse lacinia interdum felis eu consectetur. Vivamus sit amet ante est, sit amet rutrum augue. Cras non sem sem, at eleifend mi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Aenean venenatis egestas iaculis. Nullam consectetur condimentum dolor at bibendum.Nulla in enim quis ipsum pulvinar imperdiet vitae nec velit. Donec non urna quam.</p>
					<a class="btn btn-default" href="#">
						Read More
						<i class="fa-chevron-right"></i>
					</a>
				</div>

				<!-- End Main Text -->
				
			</div>
			<div class="row">
				<!-- Portfolio -->
				<!-- Portfolio Item -->
				<div class="portfolio-item col-sm-4 animate fadeIn">
					<div class="image-hover">
						<a href="#">
							<figure>
								<img src="assets/img/f.jpg" alt="image1">
								<div class="overlay">
									<a class="expand" href="#">Image Link</a>
								</div>
							</figure>
							<h3 class="margin-top-20">Tires</h3>
							<p class="margin-top-10 margin-bottom-20">BMW G Series Tires</p>
							<div class="btn btn-default">
								<a class="info" href="">See More</a>
							</div>
						</a>
					</div>
				</div>
				<!-- //Portfolio Item// -->
				<!-- Portfolio Item -->
				<div class="portfolio-item col-sm-4 animate fadeIn">
					<div class="image-hover">
						<a href="#">
							<figure>
								<img src="assets/img/e.jpeg" alt="image2">
								<div class="overlay">
									<a class="expand" href="#">Image Link</a>
								</div>
							</figure>
							<h3 class="margin-top-20">Mufflers</h3>
							<p class="margin-top-10 margin-bottom-20">BMW 4 Series Mufflers</p>
							<div class="btn btn-default">
								<a class="info" href="">See more</a>
							</div>
						</a>
					</div>
				</div>
				<!-- //Portfolio Item// -->
				<!-- Portfolio Item -->
				<div class="portfolio-item col-sm-4 animate fadeIn">
					<div class="image-hover">
						<a href="#">
							<figure>
								<img src="assets/img/d.jpg" alt="image3">
								<div class="overlay">
									<a class="expand" href="#">Image Link</a>
								</div>
							</figure>
							<h3 class="margin-top-20">Engines</h3>
							<p class="margin-top-10 margin-bottom-20">BMW 9 Series Engines</p>
							<div class="btn btn-default">
								<a class="info" href="">See more</a>
							</div>
						</a>
					</div>
				</div>
				<!-- //Portfolio Item// -->
				<!-- End Portfolio -->
			</div>
			
		</div>
	</div>
	<!-- === END CONTENT === -->
	<?php include('footer.php');?>