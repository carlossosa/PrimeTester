<?php
require 'Test/TestInterface.php';
require 'Test/SimpleTest.php';
require 'Test/MillerRobinTest.php';
require 'Test/FermatLittleTheoremTest.php';
require 'Test/GMPLibraryTest.php';
require 'Exception/FailRequirementException.php';
require 'PrimeTester.php';

$pn = rand(1,9999999999999);

echo "Test for $pn \n\n";

echo "Simple\t\t";
$t = microtime(true);
echo ( PrimeTester\PrimeTester::getInstance()->is($pn) ) ? "TRUE":"FALSE";
echo "\t (". (microtime(true)-$t) .")\n";


echo "Miller-Robin\t";
$t = microtime(true);
$p = new PrimeTester\PrimeTester(new PrimeTester\Test\MillerRobinTest());
echo ($p->is($pn))? "TRUE":"FALSE";
echo "\t (". (microtime(true)-$t) .")\n";


echo "Fermat\t\t";
if ( $pn > 10000){
    echo "-\t-";
    exit();
}
$t = microtime(true);
$p = new PrimeTester\PrimeTester(new PrimeTester\Test\FermatLittleTheoremTest());
set_time_limit(5);
echo ($p->is($pn))? "TRUE":"FALSE";
echo "\t (". (microtime(true)-$t) .")\n";

//5001779
?>