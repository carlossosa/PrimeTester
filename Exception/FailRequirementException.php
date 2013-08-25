<?php
namespace PrimeTester\Exception;

/**
 * 
 */
class FailRequimentException extends \ErrorException {
    public function __construct($message) {
        parent::__construct($message);
    }
}