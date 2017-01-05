<?php

/**
 * Copyright (c) 2016 Honeyfund.com, Inc.
 *
 * https://opensource.org/licenses/MIT
 */

use \Honeyfund\AffiliatizeMe;

class AffiliatizeMeTest extends PHPUnit_Framework_TestCase
{
	private $arrAffiliates;

    function __construct()
    {
		$this->arrAffiliates = array(
			"macys" => array(
				"in"	=> "http://www.macys.com/",
				"out"	=> ""
			),
			"bloomingdales" => array(
			)
		);

	}

	public function testMacys()
	{
		$this->assertEquals(AffiliatizeMe::convert($this->arrAffiliates['macys']['in']), "");
	}
}
