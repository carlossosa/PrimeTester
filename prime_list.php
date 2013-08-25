<?php

require 'Test/TestInterface.php';
require 'Test/SimpleTest.php';
require 'Test/MillerRobinTest.php';
require 'Test/FermatLittleTheoremTest.php';
require 'Test/GMPLibraryTest.php';
require 'Exception/FailRequirementException.php';
require 'PrimeTester.php';

$simple = \PrimeTester\PrimeTester::getInstance(PrimeTester\PrimeTester::TEST_SIMPLE); 
$fermat = \PrimeTester\PrimeTester::getInstance(PrimeTester\PrimeTester::TEST_FERMAT);
$mr = \PrimeTester\PrimeTester::getInstance(PrimeTester\PrimeTester::TEST_MILLER_ROBIN);
$s = 0;
$t = microtime(true);
for ( $i = 200000; $i <= 300000; ++$i) {
    if ( $mr->is($i)){
        //echo "$i,\033\t";
        printf("\033[%sm%s\033[0m,\t", ($s%2==0)?33:37, $i);
        if ( $s<9)
            $s++;
        else {
            $s=0;echo "\n";
        }
    }
}
printf("\nGenerated in: \033[%sm%s\033[0m\t", implode(';', array(37,44)), (microtime(true)-$t));
?>