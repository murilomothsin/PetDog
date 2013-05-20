<?php

class Upload{

	// Public vars
	public $file_type;
	public $file_size;
	public $file_extension;
	public $file_dimensions;
	public $file_new_dimensions 		= array('width' => NULL, 'height' => NULL);
	public $created_image;

	public $allowed_file_type 			= array("image/gif", "image/jpeg", "image/png", "image/pjpeg");
	public $allowed_file_size 			= 10000000;
	public $allowed_file_dimensions 	= array('width' => 70, 'height' => 70);



	//Image Settings
	public function image_settings($file, $path, $name){

		$properties 			= getimagesize($file);
		$this->file_extension 	= end(explode('/', $properties['mime']));
		$this->file_type 		= $properties['mime'];
		$this->file_size 		= filesize($file);
		$this->file_dimensions 	= array('width' => $properties[0], 'height' => $properties[1]);
		$this->source_file 		= $file;
		$this->new_path 		= $path;
		$this->new_name 		= $name;
		$this->new_path_file 	= $this->new_path . $this->new_name . '.' . $this->file_extension;
	}

	// GETTERS
	public function get_file_type(){
		return $this->file_type;
	}

	public function get_file_size(){
		return $this->file_size;
	}

	public function get_file_extension(){
		return $this->file_extension;
	}

	public function get_file_dimensions($witch){
		return $this->file_dimensions[$witch];
	}

	public function get_file_name(){
		return $this->new_name . '.' . $this->file_extension;
	}


	// CORE CLASS
	public function upload_file($file = NULL, $path = NULL, $name = NULL){

		$this->image_settings($file, $path, $name);

		if ($this->isAllowed()){
			if ($this->handle_image_dimensions())
				if ($this->save_image())
					return TRUE;
		}
		else
			return FALSE;
	}

	// Verify Image Properties
	public function isAllowed(){
		if ($this->has_allowed_type() && 
			$this->has_allowed_size())
				return TRUE;
		else
			return FALSE;
	}

	public function has_allowed_type(){
		return (in_array($this->get_file_type(), $this->allowed_file_type)) ? TRUE : FALSE;
	}

	public function has_allowed_size(){
		return 	($this->get_file_size() <= $this->allowed_file_size) ? TRUE : FALSE;
	}

	public function has_allowed_dimensions(){
		if($this->get_file_dimensions('width') <= $this->allowed_file_dimensions['width'] && $this->get_file_dimensions('height') <= $this->allowed_file_dimensions['height'] )
			return TRUE;
		else
			return FALSE;
	}

	public function create_image($file){
		switch ($this->get_file_extension()) {
		 	case 'jpg':
		 	case 'jpeg':
		 		$this->created_image = ImageCreateFromJPEG($file);
		 		break;
		 	case 'png':
		 		$this->created_image = ImageCreateFromPNG($file);
		 		break;
		 	case 'gif':
		 		$this->created_image = ImageCreateFromGIF($file);
		 		break;
		 	
		 	default:
		 		$this->created_image = ImageCreateFromJPEG($file);
		 		break;
		 }
	}

	public function handle_image_dimensions(){
		if ($this->has_allowed_dimensions())
			return TRUE;
		else
			return $this->resize_image();
	}

	public function resize_image(){
		$percent 								= min(round(($this->allowed_file_dimensions['width'] / $this->get_file_dimensions('width')),4),round(($this->allowed_file_dimensions['height']/$this->get_file_dimensions('height')),4),2);

		$this->file_new_dimensions['width'] 	= floor($this->get_file_dimensions('width') * $percent);
		$this->file_new_dimensions['height'] 	= floor($this->get_file_dimensions('height') * $percent); 

		return TRUE;
	}

	//Move the file
	public function save_image(){
		$this->create_image($this->source_file);

		// Resize
		if ($this->file_new_dimensions['width'] <> '' || $this->file_new_dimensions['height'] <> ''){

			$this->output_image = ImageCreateTrueColor($this->file_new_dimensions['width'], $this->file_new_dimensions['height']);
			imagealphablending($this->output_image, false);
			imagesavealpha($this->output_image, true);
			ImageCopyResampled($this->output_image, $this->created_image, 0, 0, 0, 0, $this->file_new_dimensions['width'], $this->file_new_dimensions['height'], $this->get_file_dimensions('width'), $this->get_file_dimensions('height'));

			if ($this->file_extension == 'png')
				imagePNG($this->output_image, $this->new_path_file);
			
			elseif ($this->file_extension == 'jpg' || $this->file_extension == 'jpeg') 
				imageJPEG($this->output_image, $this->new_path_file);
			
			elseif ($this->file_extension == 'gif') 
				imageGIF($this->output_image, $this->new_path_file);
		}
		else
			copy($this->source_file, $this->new_path_file);

		// Rights for the file
		chmod($this->new_path . $this->new_name . '.' . $this->file_extension, 0777);

		return TRUE;
	}
}

$upload = new Upload();
?>