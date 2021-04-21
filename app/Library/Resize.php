<?php
namespace App\Library;

class Resize{

	private $image;
	private $width;
	private $height;
	private $imageResized;

 	function __construct($fileName){
   		$this->image = $this->openImage($fileName);
   		$this->width = imagesx($this->image);
   		$this->height = imagesy($this->image);
 	}

 	private function openImage($file){
   	$extension = $file->getClientOriginalExtension();
   	// dd($extension);
   	$file_ = $file->getPathName();
   	switch ($extension) {
   		 	case 'jpg': case 'jpeg': case 'JPG':
            $img = imagecreatefromjpeg($file_);
            break;
        case 'gif':
            $img = imagecreatefromgif($file_);
            break;
        case 'png':
            $img = imagecreatefrompng($file_);
            break;
        default:
            $img = false;
            break;
    }
    	return $img;
 	}

 	public function resizeImage($newWidth, $newHeight, $option="auto"){
     // *** Get optimal width and height - based on $option
    $optionArray = $this->getDimensions($newWidth, $newHeight, strtolower($option));
    $optimalWidth  = $optionArray['optimalWidth'];
    $optimalHeight = $optionArray['optimalHeight'];
 	 	$y_initial = round(($newHeight - $optimalHeight) / 2);

 		// dd($y_initial);
    // *** Resample - create image canvas of x, y size
    $this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
   	$white = imagecolorallocate($this->imageResized , 255, 255, 255);
    imagealphablending($this->imageResized, false);
    imagesavealpha($this->imageResized, true);
    imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);
    imagefill( $this->imageResized,0,0,$white); 
 
    // *** if option is 'crop', then crop too
    if ($option == 'crop') {
        $this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
    }
	}

	private function getDimensions($newWidth, $newHeight, $option){
    switch ($option)
    {
        case 'exact':
            $optimalWidth = $newWidth;
            $optimalHeight= $newHeight;
            break;
        case 'portrait':
            $optimalWidth = $this->getSizeByFixedHeight($newHeight);
            $optimalHeight= $newHeight;
            break;
        case 'landscape':
            $optimalWidth = $newWidth;
            $optimalHeight= $this->getSizeByFixedWidth($newWidth);
            break;
        case 'auto':
            $optionArray = $this->getSizeByAuto($newWidth, $newHeight);
            $optimalWidth = $optionArray['optimalWidth'];
            $optimalHeight = $optionArray['optimalHeight'];
            break;
        case 'crop':
            $optionArray = $this->getOptimalCrop($newWidth, $newHeight);
            $optimalWidth = $optionArray['optimalWidth'];
            $optimalHeight = $optionArray['optimalHeight'];           
            break;
    }
    return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	private function getSizeByFixedHeight($newHeight){
    $ratio = $this->width / $this->height;
    $newWidth = $newHeight * $ratio;
    return $newWidth;
}
 
private function getSizeByFixedWidth($newWidth){
    $ratio = $this->height / $this->width;
    $newHeight = $newWidth * $ratio;
    return $newHeight;
}
 
private function getSizeByAuto($newWidth, $newHeight){
    if ($this->height < $this->width)
    // *** Image to be resized is wider (landscape)
    {
        $optimalWidth = $newWidth;
        $optimalHeight= $this->getSizeByFixedWidth($newWidth);
    }
    elseif ($this->height > $this->width)
    // *** Image to be resized is taller (portrait)
    {
        $optimalWidth = $this->getSizeByFixedHeight($newHeight);
        $optimalHeight= $newHeight;
    }
    else
    // *** Image to be resizerd is a square
    {
        if ($newHeight < $newWidth) {
            $optimalWidth = $newWidth;
            $optimalHeight= $this->getSizeByFixedWidth($newWidth);
        } else if ($newHeight > $newWidth) {
            $optimalWidth = $this->getSizeByFixedHeight($newHeight);
            $optimalHeight= $newHeight;
        } else {
            // *** Sqaure being resized to a square
            $optimalWidth = $newWidth;
            $optimalHeight= $newHeight;
        }
    }
 
    return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}
 
	private function getOptimalCrop($newWidth, $newHeight){
	 
	    $heightRatio = $this->height / $newHeight;
	    $widthRatio  = $this->width /  $newWidth;
	 
	    if ($heightRatio < $widthRatio) {
	        $optimalRatio = $heightRatio;
	    } else {
	        $optimalRatio = $widthRatio;
	    }
	 
	    $optimalHeight = $this->height / $optimalRatio;
	    $optimalWidth  = $this->width  / $optimalRatio;
	 
	    return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight){

    // *** Find center - this will be used for the crop
    $cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
    $cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );
 
    $crop = $this->imageResized;
    //imagedestroy($this->imageResized);
 
    // *** Now crop from center to exact requested size
    $this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
    	$white = imagecolorallocate($this->imageResized , 255, 255, 255);
        // removing the black from the placeholder

        // turning off alpha blending (to ensure alpha channel information
        // is preserved, rather than removed (blending with the rest of the
        // image in the form of black))
    imagealphablending($this->imageResized, false);

        // turning on alpha channel information saving (to ensure the full range
        // of transparency is preserved)
    imagesavealpha($this->imageResized, true);
    imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
    imagefill( $this->imageResized,0,0,$white); 
	}	

	public function getResizedImage(){
		return $this->imageResized;
	}


}