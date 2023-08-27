<?php 
/**
 * @author      Peter Chigozie(NG) peterujah
 * @copyright   Copyright (c), 2023 Peter(NG) peterujah
 * @license     MIT public license
 */
namespace Peterujah\NanoBlockTech\Stamp\Exception;
class StampException extends \Exception {
    public function __construct($message = "Image creation failed.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
