<?php

/**
 * Copyright (c) 2016 Honeyfund.com, Inc.
 *
 * https://opensource.org/licenses/MIT
 */

namespace Honeyfund\AffiliatizeMe;

class AffiliatizeMe
{
	private static $strLinkShareID = "REPLACE_WITH_YOUR_LINKSHARE_ID";

	/**
	 * Generate an "affiliatized" URL based on the input URL
	 *
	 * @param	string	$strURL	URL we would like to make into an affiliate link
	 *
	 * @return	string	URL that has been made into an affiliate link when possible.
	 * 					If the URL is not able to be converted, the original URL is returned.
	 */
	public static function convert($strURL)
	{
		// first determine if the input is a URL
		// determine if host of URL can be affiliatized
		// choose proper affiliate URL prefix for host

		$strResultURL = $strURL;
		if(!empty($strURL))
		{
			$arrURL = parse_url($strURL);
			if(!isset($arrURL['scheme']) || !isset($arrURL['host']))
			{
				$strURL = "http://" . ltrim($strURL, "/:");
				$arrURL = parse_url($strURL);
			}

			// See LinkShare's documentation on creating an affiliate link at:
			// http://blog.marketing.rakuten.com/2010/04/a-new-way-to-build-tracking-links
			// http://click.linksynergy.com/deeplink?id=xxxxxxxxxxx&mid=11111&murl=[encoded_url]
			// • id= The unique 11-character code that tells LinkShare which Publisher referred the click
			// • mid= The ID of the Advertiser who you are creating a link to
			// • murl= The Advertiser landing page where your visitors will be taken
			// • u1= Optional field to track sub-sites or members
			if(AffiliatizeMe::_isLinkShareURL($arrURL))
			{
				$strID = AffiliatizeMe::$strLinkShareID;
				$strMID = AffiliatizeMe::_getLinkShareMID($arrURL);
				$strEncodedURL = urlencode(AffiliatizeMe::_cleanURL($strURL));
				$strResultURL = "http://click.linksynergy.com/deeplink?id=" . $strID . "&mid=" . $strMID . "&murl=" . $strEncodedURL;
			}
		}
		
		return $strResultURL;
	}

	/**
	 * This method takes a parsed URL array and determines if it is a LinkShare affiliate
	 *
	 * @param	array	$arrURL
	 * @return	boolean	true if LinkShare URL; false otherwise
	 */
	private static function _isLinkShareURL($arrURL)
	{
		$bResult = false;
		if(	preg_match('/\bmacys\./i', $arrURL['host']) ||
			preg_match('/\bbloomingdales\./i', $arrURL['host']) ||
			preg_match('/\bwalmart\./i', $arrURL['host']) ||
			preg_match('/\bbestbuy\./i', $arrURL['host']) ||
			preg_match('/\bmichaelcfina\./i', $arrURL['host']) ||
			preg_match('/\bkohls\./i', $arrURL['host']) ||
			preg_match('/\blq\./i', $arrURL['host']) ||
			preg_match('/\blaquinta\./i', $arrURL['host']) ||
			preg_match('/\bstarwoodhotels\./i', $arrURL['host']) ||
			preg_match('/\banthropologie\./i', $arrURL['host']) ||
			preg_match('/\bnordstrom\./i', $arrURL['host']) ||
			preg_match('/\bhilton\./i', $arrURL['host']))
		{
			$bResult = true;
		}
		
		return $bResult;
	}
	
	/**
	 * This method takes a parsed URL array and returns the correct MID
	 *
	 * @param	array	$arrURL
	 * @return	string	appropriate MID or empty string
	 */
	private static function _getLinkShareMID($arrURL)
	{
		$strMID = "";
		if(preg_match('/\bmacys\./i', $arrURL['host']))
		{
			$strMID = "3184";
		}
		else if(preg_match('/\bbloomingdales\./i', $arrURL['host']))
		{
			$strMID = "13867";
		}
		else if(preg_match('/\bwalmart\./i', $arrURL['host']))
		{
			$strMID = "2149";
		}
		else if(preg_match('/\bbestbuy\./i', $arrURL['host']))
		{
			$strMID = "38606";
		}
		else if(preg_match('/\bmichaelcfina\./i', $arrURL['host']))
		{
			$strMID = "40271";
		}
		else if(preg_match('/\bkohls\./i', $arrURL['host']))
		{
			$strMID = "38605";
		}
		else if(preg_match('/\blq\./i', $arrURL['host']) || preg_match('/\blaquinta\./i', $arrURL['host']))
		{
			$strMID = "2808";
		}
		else if(preg_match('/\bstarwoodhotels\./i', $arrURL['host']))
		{
			$strMID = "41164";
		}
		else if(preg_match('/\banthropologie\./i', $arrURL['host']))
		{
			$strMID = "39789";
		}
		else if(preg_match('/\bnordstrom\./i', $arrURL['host']))
		{
			$strMID = "1237";
		}
		else if(preg_match('/\bhilton\./i', $arrURL['host']))
		{
			$strMID = "41650";
		}
		
		return $strMID;
	}

	/**
	 * This method takes some 'url string' that may have been added by a user
	 * and pre-appends 'http://' | 'https://' so that the url is valid
	 *
	 * @param	string	$strURL
	 * @return	string	cleaned up URL
	 */
	private static function _cleanURL($strURL)
	{
		$strResultURL = "";
		if (!empty($strURL))
		{
			// Clean up the link, if necessary
			$arrURL = parse_url($strURL);
			$strscheme = (empty($arrURL['scheme']) ? 'http':$arrURL['scheme']);
			$strscheme = (((strcasecmp($strscheme, 'http') == 0) || (strcasecmp($strscheme, 'https') == 0)) ? $strscheme:'http');
			return $strscheme.'://'.$arrURL['host']
				  .(empty($arrURL['path']) ? '/':$arrURL['path'])
				  .(empty($arrURL['query']) ? '':'?'.$arrURL['query']);
		}
		
		return $strResultURL;
	}
}
