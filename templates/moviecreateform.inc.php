<?php
	
	$state = isset($_GET['id']) ?  "Edit" : "Add";
	$path = ($state === "Edit") ? "./?page=movie.update" : "./?page=movie.store";
	

?>
<div class="row">
	<div class="col-xs-12">
		<h1><?= $state;?> Movie</h1>
			<form class="form-horizontal" method="post" action=<?= $path;?> enctype="multipart/form-data">
				
				<?php if($state === "Edit"):?>
					<input type="hidden" name="id" value="<?=$movie->id;?>">
				<?php endif; ?>

	            <div class="form-group">
	              <label for="title" class="col-sm-2 control-label">Movie Title</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="title" placeholder="Troll 2" name="title" value="<?php echo $movie->title;?>">
	                
	                  <span class="text-danger"><?php echo $movie->errors['title']?></span>
	                
	              </div>
	            </div>

	            <div class="form-group">
	              <label for="year" class="col-sm-2 control-label">Released Year</label>
	              <div class="col-sm-10">
	                <input type="year" class="form-control" id="year" placeholder="1990" name="year" value="<?php echo $movie->year;?>">
	                
	                <span class="text-danger"><?php echo $movie->errors['year']?></span>
	               
	              </div>
	            </div>

	            <div class="form-group">
	              <label for="description" class="col-sm-2 control-label">Description</label>
	              <div class="col-sm-10">
	                <textarea class="form-control" id="description" placeholder="Tell us about the movie" name="description"><?php echo $movie->description;?></textarea>
	               
	                <span class="text-danger"><?php echo $movie->errors['description']?></span>
	               
	              </div>
	            </div>

	            <div class="form-group">
	            	<label for="poster" class="col-sm-2 control-label">Poster Image</label>
	            	<?php if($movie->poster != ""):?>
		            	<div class="col-sm-10">
		            		<img src="images/poster/thumbnails/<?=$movie->poster?>" alt="<?= $movie->title; ?> thumbnail img">
		            		<input type="hidden" name="poster" value="<?=$movie->poster;?>">

		                    <input type="checkbox" name="removeImage" value="true">Remove Image
		                     
		               	</div>
		            <?php else: ?>
		            	<div class="col-sm-10">
		            		<input type="file" name="poster" id="poster">
		            	</div>
		            <?php endif; ?>
	            </div>

	            
	          	<div class="form-group">
	            	<div class="col-sm-offset-2 col-sm-10">
	            	<?php if($state === "Edit"):?>
	              		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Save Changes </button>
	              	<?php else : ?>
	              		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Add Movie </button>
	              	<?php endif; ?>
	            	</div>
	          	</div>

        	</form>
		
	</div>
</div>