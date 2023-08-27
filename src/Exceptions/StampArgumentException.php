<?php 
namespace NanoBlockTech\Stamp\Exception;
class StampArgumentException extends \InvalidArgumentException {
    public function __construct($message = "Invalid argument exception", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
