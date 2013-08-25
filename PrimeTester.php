<?php
namespace PrimeTester;

use PrimeTester\Test\SimpleTest,
    PrimeTester\Test\FermatLittleTheoremTest,
    PrimeTester\Test\MillerRobinTest,
    PrimeTester\Test\GMPLibraryTest,
    PrimeTester\Test\TestInterface;

/**
 * Manager for prime testers
 */
class PrimeTester {
    
    //default test
    /***
     * Fermat Little Theorem Tester ( works only for low number)
     */
    const TEST_FERMAT = 'test.fermat';
    
    /**
     * Miller-Robin tester, really fast test 
     */
    const TEST_MILLER_ROBIN = 'test.millerobin';
    
    /**
     * Standard simple test fast for medium large numbers
     */
    const TEST_SIMPLE = 'test.simple';
    
    /**
     * GMP Library use Miller-Robin test
     */
    const TEST_GMPLIB = 'test.gmplib';


    /**
     *
     * @var TestInterface
     */
    protected $method;

    public function __construct($method = null) {
        if ( $method === null) {
            $this->method = new SimpleTest();
        } else 
            if ( $method instanceof TestInterface) {
                $this->method = $method;            
            } else {
                switch ( $method) {
                    case self::TEST_FERMAT:
                        $this->method = new FermatLittleTheoremTest();
                        break;
                    case self::TEST_SIMPLE:
                        $this->method = new SimpleTest();
                        break;
                    case self::TEST_MILLER_ROBIN:
                        $this->method = new MillerRobinTest();
                        break;
                    case self::TEST_GMPLIB:
                        $this->method = new GMPLibraryTest();
                        break;
                }
            }
            
        if ( ! $this->method) {
            throw new \UnexpectedValueException();
        }
            
        $this->method->requirements();
    }
    
    /**
     * Test if $n is prime number
     * 
     * @param mixed $n Prime number
     * @return boolean
     */
    public function is() {
        $args = func_get_args();
        
        return call_user_func_array(array($this->method,'test'), $args);
    }
    
    /**
     * Find prime number next to $n
     * 
     * @param mixed $n
     * @return int
     */
    public function next( $n) {
        
        if ( $n % 2 == 0 ) {
            $n++;
        } else {
            $n +=2 ;
        }
        
        while ( true) {
            if ( $this->is($n))
                return $n;
            
            $n += 2;
        }
        
    }
    
    /**
     * Find prime number prev to $n
     * 
     * @param mixed $n
     * @return int
     */
    public function prev( $n) {
        
        if ( $n % 2 == 0 ) {
            $n--;
        } else {
            $n -=2 ;
        }
        
        while ( $n > 0) {
            if ( $this->is($n))
                return $n;
            
            $n -= 2;
        }
        
    }

    /**
     * 
     * @return PrimeTester
     */
    public static function getInstance( $test = self::TEST_SIMPLE) {
        return new self( $test);
    }
    
    /**
     * 
     * @param mixed $n Prime number to test
     * @param string $test Test type
     * @return boolean
     */
    public static function test( $n, $test = 'test.simple') {
        return self::getInstance( $test)->is($n);
    }
}