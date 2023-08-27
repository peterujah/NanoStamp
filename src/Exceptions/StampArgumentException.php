<?php 
/**
 * @author      Peter Chigozie(NG) peterujah
 * @copyright   Copyright (c), 2023 Peter(NG) peterujah
 * @license     MIT public license
 */
namespace Peterujah\NanoBlockTech\Stamp\Exception;
class StampArgumentException extends \InvalidArgumentException {
    public function __construct($message = "Invalid argument exception", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
