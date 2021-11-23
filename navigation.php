<nav id= "navbar" class="navbar navbar-expand navbar-light navbar-bg col-auto" style="background-color: #9ED763;">
	<a class="sidebar-toggle js-sidebar-toggle">
		<i class="hamburger align-self-center"></i>
	</a>

	<form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
	  	<div class="align-midle-center">
	  		<i class="align-middle" data-feather="search" style="color: black;" type="submit"></i>
		</div>
    </form>

	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align">
			<?php
				include_once "request.php";
				include_once "avatar.php"; 
			?>
		</ul>
	</div>
</nav>