<?php

namespace App\Models;

use PDO;
use finfo;
use Intervention\Image\ImageManagerStatic as Image;

Class MoviesModel extends DatabaseModel
{
	protected static $tablename = 'movies';
	protected static $columns = ['id','title','year','description','poster'];

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
}
























