<?php 
/**
 * @author      Peter Chigozie(NG) peterujah
 * @copyright   Copyright (c), 2023 Peter(NG) peterujah
 * @license     MIT public license
 */
namespace Peterujah\NanoBlockTech\Stamp;
use \Peterujah\NanoBlockTech\Stamp\Colors;
use \Peterujah\NanoBlockTech\Stamp\Circle;
use \Peterujah\NanoBlockTech\Stamp\Square;
use \Peterujah\NanoBlockTech\Stamp\Exception\StampException;
use \Peterujah\NanoBlockTech\Stamp\Exception\StampArgumentException;

class Stamp {
    /** 
    * Hold stamp gd image container
    * @var resource $image
    */
    private $image;

    /** 
    * Hold stamp container class
    * @var object|Circle|Square $container
    */
    private $container;

    /** 
    * Hold stamp class version
    * @var string static::VERSION
    */
    public const VERSION = '1.0.0';
    

    /** 
    * Initialize stamp
    * @param object|Circle|Square $container
    */
    public function __construct(object $container) {
        if (!($container instanceof Circle) && !($container instanceof Square)) {
            throw new StampArgumentException("Invalid container instance. It should be an instance of Circle or Square.");
        }
        $this->container = $container;
        $this->image = imagecreatetruecolor($this->container->getWidth(), $this->container->getHeight());
        if ($this->image === false) {
            throw new StampException("Image creation failed.");
        }
        $this->setBackgroundTransparent();
        $this->container->setImage($this->image);
        $this->container->setVersion(self::VERSION);
        
    }

    /** 
    * Set stamp image container transparent background
    */
    public function setBackgroundTransparent() {
        imagesavealpha($this->image, true);
        $color = Colors::ALPHA_TRANSPARENT;
        $transparentColor = imagecolorallocatealpha($this->image, $color[0], $color[1], $color[2], $color[3]);
        if ($transparentColor === false) {
            throw new StampException("Transparent color allocation failed.");
        }
        imagefill($this->image, 0, 0, $transparentColor);
    }

    /** 
    * Get stamp image container class instance
    * @return object|Circle|Square $this->container
    */
    public function getContainerInstance(){
        return $this->container;
    }

    /** 
    * Destroy stamp image resource
    */
    public function __destruct() {
        imagedestroy($this->image);
    }
}
