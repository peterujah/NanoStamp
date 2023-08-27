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
class Square extends Output implements StampInterface {
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
    * Initialize stamp square container
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
    * Draw stamp square container border
    * @param array $drawBorder RGB
    */
    public function drawBorder(array $borderColor) {
        $squareColor = imagecolorallocate($this->image, $borderColor[0], $borderColor[1], $borderColor[2]);
        $borderWidth = 10;
        $borderInnerWidth = 40;
        
        // Outer square
        imagerectangle($this->image, $borderWidth, $borderWidth, $this->width - $borderWidth, $this->height - $borderWidth, $squareColor);
        
        // Inner square
        $innerWidth = $this->width - 2 * $borderInnerWidth;
        $innerHeight = $this->height - 2 * $borderInnerWidth;
        $innerX1 = $borderInnerWidth; 
        $innerY1 = $borderInnerWidth;
        $innerX2 = $innerX1 + $innerWidth;
        $innerY2 = $innerY1 + $innerHeight; 
        imagerectangle($this->image, $innerX1, $innerY1, $innerX2, $innerY2, $squareColor);
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

        $positionRight = $options["right"] ?? $this->height/2;
        $positionTop = $options["top"] ?? 10;

        $verticalFontHeight = imagefontheight($options["fontSize"]) - $positionTop;
        $verticalFontWidth = imagefontwidth($options["fontSize"]) * strlen($text)  + $positionRight;
        $verticalX = $centerX - ($verticalFontWidth / 2);
        $verticalY = $centerY - ($verticalFontHeight / 2);
        
        imagefttext($this->image, $options["fontSize"], 0, $verticalX, $verticalY, $textColor, $this->fontPath, $text);
    }

    /** 
    * Draw stamp square right text
    * @param string $text
    * @param array $options
    */
    public function drawRightText($text, $options) {
        $color = $options["color"];
        $textColor = imagecolorallocate($this->image, $color[0], $color[1], $color[2]);
        $centerX = $this->width / 2;
        $centerY = $this->height / 2;

        $positionTop = $options["top"] ?? $this->height/2;
        $positionRight = $options["right"] ?? 10;

        $verticalFontHeight = imagefontheight($options["fontSize"]) - $positionTop;
        $verticalFontWidth = imagefontwidth($options["fontSize"]) -  $positionRight;
        $verticalTextWidth = $verticalFontWidth * strlen($text);
        $verticalX = $centerX - ($verticalTextWidth / 2);
        $verticalY = $centerY - ($verticalFontHeight / 2);
        
        imagefttext($this->image, $options["fontSize"], 90, $verticalX, $verticalY, $textColor, $this->fontPath, $text);
    }

    /** 
    * Draw stamp square left text
    * @param string $text
    * @param array $options
    */
    public function drawLeftText($text, $options) {
        $color = $options["color"];
        $textColor = imagecolorallocate($this->image, $color[0], $color[1], $color[2]);
        $centerX = $this->width / 2;
        $centerY = $this->height / 2;

        $positionTop = $options["top"] ?? $this->height/2;
        $positionLeft = $options["left"] ?? 10;

        $verticalFontHeight = imagefontheight($options["fontSize"]) - $positionTop;
        $verticalFontWidth = imagefontwidth($options["fontSize"]);
        $verticalTextWidth = $verticalFontWidth * strlen($text) + $positionLeft;
        $verticalX = $centerX - ($verticalTextWidth / 2);
        $verticalY = $centerY - ($verticalFontHeight / 2);
        
        imagefttext($this->image, $options["fontSize"], 90, $verticalX, $verticalY, $textColor, $this->fontPath, $text);
    }
    
    /** 
    * Destroy stamp image resource
    */
    public function __destruct() {
        imagedestroy($this->image);
    }
}
