<?php
namespace PrimeTester\Test;

/**
 * Fermat little theorem ( a^p - a = b and b % p === 0 )
 */
class FermatLittleTheoremTest implements TestInterface {
    public function requirements() {
        $funcs_array = array(
            'bcpow',
            'bcmod',
            'bcsub',
        );
        
        foreach ($funcs_array as $func)
            if ( !function_exists($func))
                throw new \PrimeTester\Exception\FailRequimentException('BC Math is required for this test.');
    }

    public function test($n, $a = 2) {
        $p1 = bcpow( $a, $n);
        $p2 = bcsub( $p1, $a);
        
        if ( intval(bcmod( $p2, $n)) === 0)
                return true;
        
        return false;
    }    
}