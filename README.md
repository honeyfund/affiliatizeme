# AffiliatizeMe

**AffiliatizeMe** is a library to "affiliatize" links. This is useful to convert user-provided URLs into affiliate links so you can earn affiliate commissions. Currently supports affiliates for LinkShare.

## Build Status
[![Circle CI](https://circleci.com/gh/honeyfund/affiliatizeme.svg?style=svg)](https://circleci.com/gh/honeyfund/affiliatizeme)

## How to use AffiliatizeMe
Adjust any instances of `REPLACE_WITH_YOUR_LINKSHARE_ID` with your correct LinkShare ID. You can find this ID by creating a deep link in your LinnkShara account at: http://cli.linksynergy.com/cli/publisher/links/deeplinks.php

Once you have made these changes, you can include the library and call the static function.
```
use Honeyfund\AffiliatizeMe\AffiliatizeMe;
$strNewURL = AffiliatizeMe::convert($strURLToAffiliatize);
header("Location: " . $strNewURL);
exit;
```
