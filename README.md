PHPFIT
======

PHPFIT is a PHP5 port of the FIT acceptance test framework.
FIT was originally developed for Java by Ward Cunningham.

SYNOPSYS
--------

1) PHPFIT.php and PHPFIT/ must be in the PHP include path directory (as any PEAR package). 

2) Check the file 'phpfit-run' and change the first line according to the path of your PHP command-line interpreter (usually /usr/bin/php).

3) (optional) Create a symbolic link to 'phpfit-run'. e.g: ln -s /path/to/phpfit-run /usr/local/bin So you can run 'phpfit-run' from anywhere.

4) Run it:

4a) From Fitnesse! (http://fitnesse.org/) ;)

put this in your wiki pages:
!define COMMAND_PATTERN {php /path/to/phpfit/phpfit-fitnesse.php [/path/to/fixtures]}


4b) From the CLI:

phpfit-run path/to/input.html path/to/output.html [path/to/fixtures]

NOTE: [path/to/fixtures] is optional, by default it will check for fixtures in the include path and also relative to where you run 'phpfit-run'.

e.g: phpfit-run examples/input/arithmetic.html output.html

4c) From a Browser:

e.g: http://domain/path/to/phpfit/examples/run-web.php?input_filename=input/arithmetic.html

4d) From your own scripts:

<?php
require_once 'PHPFIT.php';

PHPFIT::run(input.html, output.html [, fixturesDirectory]);

echo file_get_contents(output.html);
?>


*Alternative: With Composer and Fit Shelf:*    
  See Readme.md of [metaclass's fit-skeleton package](https://github.com/metaclass-nl/fit-skeleton).
  (Supports Mixed Data Typing, You don't have to specify type info) 
  

DATA TYPES
===========

In your fixtures you must specify the data types of each variable and function return. e.g:

	class YourClass extends PHPFIT_Fixture_Column {
	...
	public $typeDict = array(
    	"x" 		=> "integer",
		"y" 		=> "integer",
		"plus()" 	=> "integer"
	);
	...
	}
	
here are the possibilities:

- "integer" or "int"
- "bool" or "boolean"
- "double" or "float"
- "string"
- "ScientificDouble"


TODO
----

- TimedAction: finish "time" and "split" columns
- Pass the FIT specification tests.
- Finish documenting the code according to the PEAR standard.

AUTHOR
------

Luis Floreani <luis.floreani@gmail.com>


COPYRIGHT AND LICENCE
---------------------

Copyright (c) 2002-2005 Cunningham & Cunningham, Inc.
Released under the terms of the GNU General Public License version 2 or later.
