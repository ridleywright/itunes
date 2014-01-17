iTunes API Client
==============

## Description 
This simple class-based API client, when given an app ID, makes a simple query
to Apple(TM) iTunes'(TM) and returns the info it got from Apple(TM).<br/>

## Usage

A good example of this script's usage is as follows:

	<?php
		$myawesomeapp = new itunes(123456);
		
		$mydata = $myawesomeapp->get_data();

	?>

You will be returned either a <b>FALSE</b> boolean if something went wrong
or an array with all your data, using Apple's(TM) native slug syntax.

## License 

This script is licensed under the GPL V3 License. It may not be used for evil, only good!

