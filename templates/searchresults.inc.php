<div class="row">
	<div class="col-xs-12">
		<ol class="breadcrumb">
		  <li><a href=".\">Home</a></li>
		  <li class="active">Movies</li>
		</ol>
		<h1>Search Results for '<?= $_GET['q']; ?>':</h1>
		<?php if(count($results) > 0): ?>
			<ol>
				<?php foreach ($results as $movie) :?>
					<li>
						<h3>
							<a href="./?page=featuredmovie&amp;id=<?= $movie->id; ?>">
							<?= $movie->title; ?> (<?=$movie->year; ?>)</a>
						</h3>
						<p><?= $movie->description; ?></p>

					</li>
				<?php endforeach; ?>
			</ol>
		<?php else: ?>
			<p>Weirdly enough, there are no movies to display. Spooky!!! </p>
		<?php endif; ?>	


	</div>
</div>