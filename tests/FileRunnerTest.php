<?php
error_reporting( E_ALL );

set_include_path( get_include_path()  . ':' . dirname( __FILE__ ) . '/../' );

$baseDir = realpath( dirname( __FILE__ ) . '/..' );

require_once $baseDir . '/tools/simpletest/unit_tester.php';
require_once $baseDir . '/tools/simpletest/reporter.php';
require_once $baseDir . '/PHPFIT/FileRunner.php';


class FileRunnerTest extends UnitTestCase {
	public function testArgsFail() {
		try {
            // define fake output
            if( !defined( 'STDERR' ) )  {
                define( 'STDERR', fopen( 'php://stderr', 'w' ) );
            }
            
            $argv = array();
			$result = PHPFIT_FileRunner::main($argv);
            $this->assertNotEqual( 0, $result );
		} catch (Exception $e) {
            $this->fail('expected error did not happen');   
		}
	}
	
	public function testDoInputException() {
		$inputFilename = "noexist-input.no";
		$outputFilename = $GLOBALS['baseDir'] . "/output.html";
		
		try {
			$fr = new PHPFIT_FileRunner();
			$fr->run($inputFilename, $outputFilename);
		} catch (PHPFIT_Exception_FileIO $e) {
			$this->assertEqual( 'Input file does not exist!', $e->getMessage());
			return;
		}
		$this->fail("exptected exception not thrown");
	}
	
	public function testDoOutputException() {
		$inputFilename =  $GLOBALS['baseDir'] . "/examples/input/arithmetic.html";
		$outputFilename = "nodir/nosubdir/noexist-output.no";
		
		try {
			$fr = new PHPFIT_FileRunner();
            $fr->run($inputFilename, $outputFilename);
		} catch (PHPFIT_Exception_FileIO $e) {
			$this->assertEqual('Cannot create output file in given folder. (probably a problem of file permissions)', $e->getMessage());
			return;
		}
		$this->fail("exptected exception not thrown");
	}	
}

$test = &new FileRunnerTest();
$test->run(new HtmlReporter());

?>