<?php

require '/Applications/MAMP/htdocs/crawler/composer_project/vendor/autoload.php';
use HeadlessChromium\BrowserFactory;

$saveDir='/Applications/MAMP/htdocs/crawler/php';
//
$browserFactory = new BrowserFactory('/Applications/Chromium.app/Contents/MacOS/Chromium');
var_dump($browserFactory);
//
// // starts headless chrome
$browser = $browserFactory->createBrowser([
  'headless'        => false,         // disable headless mode
  // 'connectionDelay' => 0.8,           // add 0.8 second of delay between each instruction sent to chrome,
  //'debugLogger'     => 'php://stdout' // will enable verbose mode
]);
//
// creates a new page and navigate to an url
$page = $browser->createPage();
$page->navigate('https://pbs.twimg.com/media/Bpm2geGCEAAdeWA?format=jpg&name=medium')->waitForNavigation();

// get page title
$pageTitle = $page->evaluate('document.title')->getReturnValue();
print $pageTitle;


// screenshot - Say "Cheese"! 😄
$page->screenshot()->saveToFile($saveDir.'/foo/bar.png');

// pdf
$page->pdf(['printBackground'=>false])->saveToFile($saveDir.'/foo/bar.pdf');

// bye
$browser->close();
