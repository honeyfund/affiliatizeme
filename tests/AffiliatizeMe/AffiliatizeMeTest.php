<?php

/**
 * Copyright (c) 2016 Honeyfund.com, Inc.
 *
 * https://opensource.org/licenses/MIT
 */

namespace Honeyfund\Tests\AffiliatizeMeTest;
use \PHPUnit_Framework_TestCase;
use Honeyfund\AffiliatizeMe\AffiliatizeMe;

class AffiliatizeMeTest extends PHPUnit_Framework_TestCase
{
	private $arrAffiliates;

    function __construct()
    {
		$strLinkShareID = "REPLACE_WITH_YOUR_LINKSHARE_ID";
		$this->arrAffiliates = array(
			"macys" => array(
				"in"	=> "http://www.macys.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=3184&murl=http%3A%2F%2Fwww.macys.com%2F"
			),
			"bloomingdales" => array(
				"in"	=> "http://www.bloomingdales.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=13867&murl=http%3A%2F%2Fwww.bloomingdales.com%2F"
			),
			"walmart" => array(
				"in"	=> "http://www.walmart.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=2149&murl=http%3A%2F%2Fwww.walmart.com%2F"
			),
			"bestbuy" => array(
				"in"	=> "http://www.bestbuy.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=38606&murl=http%3A%2F%2Fwww.bestbuy.com%2F"
			),
			"michaelcfina" => array(
				"in"	=> "http://www.michaelcfina.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=40271&murl=http%3A%2F%2Fwww.michaelcfina.com%2F"
			),
			"kohls" => array(
				"in"	=> "http://www.kohls.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=38605&murl=http%3A%2F%2Fwww.kohls.com%2F"
			),
			"lq" => array(
				"in"	=> "http://www.lq.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=2808&murl=http%3A%2F%2Fwww.lq.com%2F"
			),
			"laquinta" => array(
				"in"	=> "http://www.laquinta.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=2808&murl=http%3A%2F%2Fwww.laquinta.com%2F"
			),
			"starwoodhotels" => array(
				"in"	=> "http://www.starwoodhotels.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=41164&murl=http%3A%2F%2Fwww.starwoodhotels.com%2F"
			),
			"anthropologie" => array(
				"in"	=> "http://www.anthropologie.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=39789&murl=http%3A%2F%2Fwww.anthropologie.com%2F"
			),
			"nordstrom" => array(
				"in"	=> "http://www.nordstrom.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=1237&murl=http%3A%2F%2Fwww.nordstrom.com%2F"
			),
			"hilton" => array(
				"in"	=> "http://www.hilton.com/",
				"out"	=> "http://click.linksynergy.com/deeplink?id=".$strLinkShareID."&mid=41650&murl=http%3A%2F%2Fwww.hilton.com%2F"
			)
		);

	}

	public function testValidLinks()
	{
		foreach($this->arrAffiliates as $arrAffiliate)
		{
			$this->assertEquals(AffiliatizeMe::convert($arrAffiliate['in']), $arrAffiliate['out']);
		}
	}

	public function testInvalidLink()
	{
		$this->assertNotEquals(AffiliatizeMe::convert($this->arrAffiliates['macys']['in']), $this->arrAffiliates['macys']['in']);
	}

	public function testNotAffiliateLink()
	{
		$this->assertEquals(AffiliatizeMe::convert("https://www.honeyfund.com/"), "https://www.honeyfund.com/");
	}

	public function testEmptyLink()
	{
		$this->assertEquals(AffiliatizeMe::convert(""), "");
	}

	public function testNoSchemeLinks()
	{
		$this->assertEquals(AffiliatizeMe::convert("www.macys.com"), $this->arrAffiliates['macys']['out']);
		$this->assertEquals(AffiliatizeMe::convert("//www.macys.com"), $this->arrAffiliates['macys']['out']);
	}
}
