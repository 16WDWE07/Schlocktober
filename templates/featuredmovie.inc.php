
<div class="row">
	<div class="col-xs-12">
		<ol class="breadcrumb">
		  <li><a href="./">Home</a></li>
		  <li><a href="./?page=movies">Movies</a></li>
		  <li class="active"><?= $featuredmovie->title;?></li>
		</ol>

	  <h1><?= $featuredmovie->title;?></h1>
	  <small>Released in the year - <?= $featuredmovie->year?></small>

	  <?php if($featuredmovie->poster != ""):?>
	  	<p>
	  		<img src="images/poster/<?=$featuredmovie->poster;?>" alt="<?=$featuredmovie->title;?>">
	  	</p>
	  <?php else:?>
	  	<p> No posters found !!! </p>
	  <?php endif; ?> 

	  <p><?= $featuredmovie->description?></p>	  
	</div>
	<div class="col-xs-12">
	<?php if(isset($_SESSION['privilege']) && $_SESSION['privilege'] === 'admin'):?>
  		<a href="./?page=movie.edit&amp;id=<?= $featuredmovie->id;?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Edit Movie</a>
  		<a href="./?page=movie.delete&amp;id=<?= $featuredmovie->id;?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete Movie</a>
  	<?php endif; ?>

  	<h3>Comments</h3>
  	<?php if(count($allComments) > 0 ):?>
  		<?php $count=0 ;?>
  		<?php foreach ($allComments as $comment):?> 
  			<?php $count++;?>
  			<h4><?= $count .'.'. $comment['email'];?></h4>
  			<p><?= $comment['comment'];?></p>
  		<?php endforeach;?>

  	<?php endif;?>
  	<section>

  		<?php if(isset($_SESSION['user_email'])): ?>
  		
  		<h6>Add Comments for <?= $featuredmovie->title;?></h6>
  		<form method="post" action="./?page=comment.create" class="form-horizontal">

  			<input type="hidden" name="movie_id" value="<?= $featuredmovie->id; ?>">

  			<div class="form-group">
              <label for="comment" class="col-sm-2 control-label">Comment</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="comment" placeholder="Add Comments" name="comment" rows="5"></textarea>               
                <span class="text-danger"></span>                
              </div>
            </div>
  			
  			<div class="form-group">
            	<div class="col-sm-offset-2 col-sm-10">
              		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Add Comments </button>            
            	</div>
          	</div>

  		</form>
  	<?php else: ?>
  		<p>You need to be <a href="./?page=login&amp;id=<?=$featuredmovie->id;?>">logged in</a> to add comments!</p>
  	<?php endif; ?>
  	</section>
  	</div>
</div>

















