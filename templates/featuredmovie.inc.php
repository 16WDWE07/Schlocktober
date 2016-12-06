<div class="row">
	<div class="col-xs-12">
		<ol class="breadcrumb">
		  <li><a href="./">Home</a></li>
		  <li><a href="./?page=movies">Movies</a></li>
		  <li class="active"><?= $featuredmovie['title'];?></li>
		</ol>

	  <h1><?= $featuredmovie['title'];?></h1>
	  <small>Released in the year - <?= $featuredmovie['year']?></small>
	  <p><?= $featuredmovie['description']?></p>	  
	</div>
	<div class="col-xs-12">
	<?php if(isset($_SESSION['privilege']) && $_SESSION['privilege'] === 'admin'):?>
  		<a href="./?page=movie.edit&amp;id=<?= $featuredmovie['id'];?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Edit Movie</a>
  		<a href="./?page=movie.delete&amp;id=<?= $featuredmovie['id'];?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete Movie</a>
  	<?php endif; ?>
  	</div>
</div>