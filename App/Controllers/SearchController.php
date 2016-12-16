<?php
namespace App\Controllers;

use App\Views\SearchResultsView;
use App\Models\MoviesModel;

Class SearchController
{
	public function search(){

		$query = isset($_GET['q']) ? $_GET['q'] : "";

		$movies = new MoviesModel();
		$results = $movies->search($query);

		$view = new SearchResultsView(compact('results'));
     	$view->render();
	}
}