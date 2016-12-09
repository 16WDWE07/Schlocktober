<?php
namespace App\Controllers;

use App\Views\MoviesView;
use App\Models\MoviesModel;
use App\Views\FeaturedMovieView;
use App\Views\MovieCreateView;
use App\Models\CommentsModel;

Class MoviesController
{
	public function showAll(){

		$movies = new MoviesModel();
		$moviesList = $movies->showAll();

		$view = new MoviesView(compact('moviesList'));
     	$view->render();
	}

	public function showFeaturedMovie(){
		
		$featuredmovie = new MoviesModel($_GET['id']);	

		$comments = new CommentsModel();
		$allComments = $comments->getAllComments($_GET['id']);	

		$view = new FeaturedMovieView(compact('featuredmovie', 'allComments'));
		$view->render();
	}
	public function create(){

		$movie = new MoviesModel();
		$view = new MovieCreateView(compact('movie'));
		$view->render();
	}
	public function store(){
		
		$movie = new MoviesModel($_POST);
		$movie->save();	
		header("Location:./?page=featuredmovie&id=". $movie->id);

	}
	public function storeComments(){
		$input = $_POST;
		$input['user_id'] = $_SESSION['user_id'];

		$comment = new CommentsModel($input);
		$comment->save();
		header("Location:./?page=featuredmovie&id=".$comment->movie_id);
	}
	public function edit(){

		$movie = new MoviesModel($_GET['id']);

		$view = new MovieCreateView(compact('movie'));
		$view->render();

	}
	public function update(){
		
		$movie = new MoviesModel($_POST);
		$movie->update();
		header("Location:./?page=featuredmovie&id=".$movie->id);
	}

	public function delete(){
		$movieID = isset($_GET['id']) ? $_GET['id'] : null;
		MoviesModel::destroy($movieID);
		header("Location:./?page=movies");
	}
}















