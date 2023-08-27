<?php 
/**
 * @author      Peter Chigozie(NG) peterujah
 * @copyright   Copyright (c), 2023 Peter(NG) peterujah
 * @license     MIT public license
 */
namespace Peterujah\NanoBlockTech\Stamp;
use \Peterujah\NanoBlockTech\Stamp\StampInterface;
use \Peterujah\NanoBlockTech\Stamp\Output;
use \Peterujah\NanoBlockTech\Stamp\Exception\StampException;
class Circle extends Output implements StampInterface {
    /** 
    * Hold stamp gd image container
    * @var resource $image
    */
    private $image;

    /** 
    * Hold stamp font path
    * @var string $fontPath
    */
    private $fontPath;

    /** 
    * Hold stamp image container width
    * @var int $width
    */
    private $width;

    /** 
    * Hold stamp image container height
    * @var int $height
    */
    private $height;
    
    /** 
    * Hold stamp class version
    * @var string $version
    */
    private $version;
    
    /** 
    * Initialize stamp circle container
    * @param int $width
    * @param int $height
    */
    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

     /** 
    * Set stamp image gd resource and initialize parent output class
    * @param resource $image
    */
    public function setImage($image) {
        $this->image = $image;
        parent::__construct($this->image, $this->version);
    }

    /** 
    * Set stamp font path
    * @param string $fontPath
    */
    public function setFont($fontPath) {
        $this->fontPath = $fontPath;
    }

    /** 
    * Set stamp class version
    * @param string $version
    */
    public function setVersion($version) {
        $this->version = $version;
    }

    /** 
    * Get stamp container height
    * @return int $this->height
    */
    public function getHeight() {
        return $this->height;
    }

    /** 
    * Get stamp container width
    * @return int $this->width
    */
    public function getWidth() {
        return $this->width;
    }
    
    /** 
    * Set stamp container background image color
    * @param array $color RGBA
    */
    public function setBackgroundColor(array $color) {
        $backgroundColor = imagecolorallocatealpha($this->image, $color[0], $color[1], $color[2], $color[3]);
        if ($backgroundColor === false) {
            throw new StampException("Background color allocation failed.");
        }
        imagefill($this->image, 0, 0, $backgroundColor);
    }
    
    /** 
    * Draw stamp circle container border
    * @param array $drawBorder RGB
    */
    public function drawBorder($color) {
        $centerX = $this->width / 2;
        $centerY = $this->height / 2;
        $circleColor = imagecolorallocate($this->image, $color[0], $color[1], $color[2]);
        $radius = min($centerX, $centerY) - 10;
        
        // Outer circle
        imageellipse($this->image, $centerX, $centerY, $radius * 2, $radius * 2, $circleColor);
        
        // Inner circle
        imageellipse($this->image, $centerX, $centerY, $radius * 2 - 100, $radius * 2 - 100, $circleColor);
    }
    
    /** 
    * Draw stamp round text within the circle border
    * @param string $text
    * @param int $fontSize
    * @param array $color RGB
    * @param bool $increment
    */
    public function drawRoundText($text, $fontSize, $color, $increment = false) {
        $textColor = imagecolorallocate($this->image, $color[0], $color[1], $color[2]);
        
        $degree = -150;
        $paddingTop = 20;
        $paddingLeft = 5;
        $paddingRadius = 50;
        $textSpacing = 330;
    
        $centerX = $this->width / 2;
        $centerY = $this->height / 2;
        
        $outerRadius = min($centerX, $centerY) - 10;
        $innerRadius = $outerRadius - $paddingRadius; 
        $radius = ($outerRadius + $innerRadius) / 2;
        
        // Draw the round text
        $angle = $textSpacing / strlen($text);
        $fontHeight = imagefontheight($fontSize);
        
        if($increment){
            $angleIncrement = $angle;
            for ($i = 0; $i < strlen($text); $i++) {
                $angle = $degree + $i * $angleIncrement;
                $x = $centerX + cos(deg2rad($angle)) * $radius - ($fontHeight / 2) + $paddingLeft;
                $y = $centerY + sin(deg2rad($angle)) * $radius - ($fontHeight / 2) + $paddingTop;
                imagefttext($this->image, $fontSize, 0, $x, $y, $textColor, $this->fontPath, $text[$i]);
            }
        }else{
            for ($i = 0; $i < strlen($text); $i++) {
                $x = $centerX + cos(deg2rad($i * $angle - $degree)) * $radius - ($fontHeight / 2) + $paddingLeft;
                $y = $centerY + sin(deg2rad($i * $angle - $degree)) * $radius - ($fontHeight / 2) + $paddingTop;
                imagefttext($this->image, $fontSize, $angle + $i, $x, $y, $textColor, $this->fontPath, $text[$i]);
            }
        }
    }

    /** 
    * Draw stamp vertical text in center of circle border
    * @param string $text
    * @param array $options
    */
    public function drawVerticalText($text, $options) {
        $color = $options["color"];
        $textColor = imagecolorallocate($this->image, $color[0], $color[1], $color[2]);
        $centerX = $this->width / 2;
        $centerY = $this->height / 2;

        $positionTop = $options["top"] ?? $this->height/2;
        $positionLeft = $options["left"] ?? 10;

        $verticalFontHeight = imagefontheight($options["fontSize"]) - $positionTop;
        $verticalFontWidth = imagefontwidth($options["fontSize"]) - $positionLeft;
        $verticalTextWidth = $verticalFontWidth * strlen($text);
        $verticalX = $centerX - ($verticalTextWidth / 2);
        $verticalY = $centerY - ($verticalFontHeight / 2);
        
        imagefttext($this->image, $options["fontSize"], 90, $verticalX, $verticalY, $textColor, $this->fontPath, $text);
    }

    /** 
    * Draw stamp center text
    * @param string $text
    * @param array $options
    */
    public function drawCenterText($text, $options) {
        $color = $options["color"];
        $textColor = imagecolorallocate($this->image, $color[0], $color[1], $color[2]);
        $centerX = $this->width / 2;
        $centerY = $this->height / 2;

        $positionTop = $options["top"] ?? $this->height/2;
        $positionLeft = $options["left"] ?? 60;
    
        // Calculate the position for horizontal text in the center of the inner circle
        $innerRadius = min($centerX, $centerY) - $positionTop;
        $textWidth = imagefontwidth($options["fontSize"]) * strlen($text) + $positionLeft;
        $textHeight = imagefontheight($options["fontSize"]);
        $startX = $centerX - ($textWidth / 2);
        $startY = $centerY - ($innerRadius / 2) - ($textHeight / 2); // Adjust this value to center vertically
    
        imagefttext($this->image, $options["fontSize"], 0, $startX, $startY, $textColor, $this->fontPath, $text);
    }
    

    /** 
    * Destroy stamp image resource
    */
    public function __destruct() {
        imagedestroy($this->image);
    }
}
