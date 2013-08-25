<?php

namespace PrimeTester\Test;

class GMPLibraryTest implements TestInterface {
    public function requirements() {
        if ( !function_exists('gmp_prob_prime'))
            throw new \PrimeTester\Exception\FailRequimentException('GMP Library is required for this test.');
    }

    public function test( $n, $a=10) {
        return gmp_prob_prime( $n, $a);
    }    
}