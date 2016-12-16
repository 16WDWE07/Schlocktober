<?php

namespace App\Models;

use PDO;
use finfo;
use Intervention\Image\ImageManagerStatic as Image;

Class MoviesModel extends DatabaseModel
{
	protected static $tablename = 'movies';
	protected static $columns = ['id','title','year','description','poster'];
	protected static $validationRules = [
						'title' 		=> 'minlength:4',
						'year'			=> 'numeric',
						'description' 	=> 'minlength:10'
	];

	public function savePoster($filename){

		// find the file mime type
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$mimetype = $finfo->file($filename);
		
		// create all possible extensions
		$extensions = [
			'image/jpg' => '.jpg',
			'image/jpeg' => '.jpg',
			'image/png' => '.png',
			'image/gif' => '.gif'
		];

		// if mime type is present, then select appropriate extension for the file
		if(isset($extensions[$mimetype])){
			$extension = $extensions[$mimetype];
		} else {
			$extension = '.jpg';
		}

		// create filename
		$newFilename = uniqid() . $extension;

		// to store the image file in database, give it to the object
		$this->poster = $newFilename;

		// creating new folder to store newFilename inorder to display the images
		$folder = "images/poster/";

		if(! is_dir($folder)){
			mkdir($folder, 0777, true);
		}

		$destination = $folder. $newFilename;
		move_uploaded_file($filename, $destination);

		$img = Image::make($destination);
		$img->fit(300,500);
		$img->save($folder . $newFilename);

		//create thumbnails folder 

		if(! is_dir("images/poster/thumbnails")){
			mkdir("images/poster/thumbnails", 0777, true);
		}
		$img = Image::make($destination);
		$img->fit(50,50);
		$img->save($folder ."thumbnails/". $newFilename);
		
	}

	public function search($searchTerm){

		$db = $this->getDatabaseConnection();

		$query = "SET @searchterm = :searchTerm";
		$statement = $db->prepare($query);
		$statement->bindValue(":searchTerm" , $searchTerm);
		$statement->execute();


		$query = "SELECT movies.id, movies.title, movies.description, movies.year 			FROM movies 
					WHERE 
						MATCH(movies.title) AGAINST(@searchterm) OR 
						MATCH(movies.description) AGAINST(@searchterm) 
						ORDER BY (movies.title) DESC";
		$statement = $db->prepare($query);
		$statement->execute();

		$searchresults = [];

		while ($record = $statement->fetch(PDO::FETCH_ASSOC)) {
			$model = new MoviesModel();
			$model->data = $record;
			array_push($searchresults , $model);
		}
		return $searchresults;

	}
}
























