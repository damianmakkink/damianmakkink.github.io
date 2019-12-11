<?php
include("../config/session.php");
?>

<nav class="navbar navbar-expand-lg navbar-dark">
	<div class="container">
		<a class="navbar-brand" href="/">Lightsaber Shop</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/shop.php">Shop</a>
				</li>
				<li class="nav-item">
					<?php if(!$_SESSION['user']): ?>
						<a class="nav-link btn btn-outline-primary white" href="/login.php">Jedi Master Login</a>
					<?php else: ?>
						<a class="nav-link btn btn-outline-primary white" href="/logout.php">Logout</a>
					<?php endif; ?>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="transition-overlay">
	<span class="loading">Patience, young padawan...</span>
	<div class="spinner-border text-light" role="status"></div>
</div>