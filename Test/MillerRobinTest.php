<?php
namespace PrimeTester\Test;

class MillerRobinTest implements TestInterface {        
    public function requirements() {
        $func_needs = array(
            'rand',
            'bcpowmod',
            'bcmod',
            'bcmul',
        );
        
        foreach (   $func_needs as $func )
            if ( !function_exists($func))
                throw new FailRequimentException('Requirements for Miller-Robin test are still incompletely.');
    }

    /**
     * Original code from http://rosettacode.org/wiki/Miller-Rabin_primality_test .
     * 
     * @param string $n 
     * @return boolean
     */
    public function test($n, $k = 10) {
            if ($n == 2)
                return true;
            if ($n < 2 || $n % 2 == 0)
                return false;

            $d = $n - 1;
            $s = 0;

            while ($d % 2 == 0) {
                $d /= 2;
                $s++;
            }

            for ($i = 0; $i < $k; $i++) {
                $a = rand(2, $n-1);

                $x = bcpowmod($a, $d, $n);
                if ($x == 1 || $x == $n-1)
                    continue;

                for ($j = 1; $j < $s; $j++) {
                    $x = bcmod(bcmul($x, $x), $n);
                    if ($x == 1)
                        return false;
                    if ($x == $n-1)
                        continue 2;
                }
                return false;
            }
            return true;
    }    
}