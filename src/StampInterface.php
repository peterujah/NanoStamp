<?php
/**
 * @author      Peter Chigozie(NG) peterujah
 * @copyright   Copyright (c), 2023 Peter(NG) peterujah
 * @license     MIT public license
 */
namespace Peterujah\NanoBlockTech\Stamp;
interface StampInterface {
    /** 
    * Set font path
    * @var string $fonPath
    */
    public function setFont(string $fontPath);

    /** 
    * Draw stamp border
    * @var array $borderColor RGB
    */
    public function drawBorder(array $borderColor);

    /** 
    * Set stamp background color
    * @var array $backgroundColor RGBA
    */
    public function setBackgroundColor(array $backgroundColor);

     /** 
    * Set stamp background image
    * @var string $filePath
    */
    public function setBackgroundImage(string $filePath);

    /** 
    * Set stamp gd image container
    * @var resource $image
    */
    public function setImage($image);

    /** 
    * get stamp image container height
    * @return int $height
    */
    public function getHeight();

    /** 
    * get stamp image container width
    * @return int $width
    */
    public function getWidth();

    /** 
    * Draw stamp center text
    * @var string $text
    * @var array $options
    */
    public function drawCenterText(string $text, array $options); 

    /** 
    * Draw stamp center image
    * @var string $filePath
    * @var array $options
    */
    public function drawCenterImage(string $filePath, array $options); 

    /** 
    * Set stamp version
    * @var string $version
    */
    public function setVersion(string $version);
}
