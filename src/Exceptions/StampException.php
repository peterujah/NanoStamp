<?php 
namespace NanoBlockTech\Stamp\Exception;
class StampException extends \Exception {
    public function __construct($message = "Image creation failed.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}