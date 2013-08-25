<?php

require 'Test/TestInterface.php';
require 'Test/SimpleTest.php';
require 'Test/MillerRobinTest.php';
require 'Test/FermatLittleTheoremTest.php';
require 'Test/GMPLibraryTest.php';
require 'Exception/FailRequirementException.php';
require 'PrimeTester.php';

//$sim = PrimeTester\PrimeTester::getInstance();
$sim = PrimeTester\PrimeTester::getInstance(\PrimeTester\PrimeTester::TEST_MILLER_ROBIN);

$n = 10000;
$s = 0;
$t = microtime(true);
while ( $n < 10500){
    $n = $sim->next($n);
    printf("\033[%sm%s\033[0m,\t", ($s%2==0)?33:37, $n);
    
    if ( $s<9)
            $s++;
        else {
            $s=0;echo "\n";
        }
}
printf("\nGenerated in: \033[%sm%s\033[0m\t", implode(';', array(37,44)), (microtime(true)-$t));
?>
