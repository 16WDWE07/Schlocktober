<?php
namespace App\Controllers;

use App\Views\MoviesView;
use App\Models\MoviesModel;
use App\Views\FeaturedMovieView;
use App\Views\MovieCreateView;

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

		$view = new FeaturedMovieView(compact('featuredmovie'));
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















