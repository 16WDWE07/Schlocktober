<?php
namespace App\Views;

Class SearchResultsView extends View 
{
	public function render(){
		$page="search";
		$title = " Search Results";
		include "templates/master.inc.php";
	}

	public function content(){
		extract($this->data);
		include "templates/searchresults.inc.php";
	}
}