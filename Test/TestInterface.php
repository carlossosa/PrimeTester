<?php
namespace PrimeTester\Test;

/**
 * 
 * @author Carlos  Sosa <carlitin@gmail.com>
 */
interface TestInterface {
   
    /**
     * 
     */
    public function requirements();
    
    /**
     * 
     */
    public function test($n);
}