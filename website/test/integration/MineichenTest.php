<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverCapabilities;

/**
 * 
 * Start Selenium-Server before executeing phpunit. e.g. :
 * docker run --rm --network phptemplate151_fpm selenium/standalone-chrome
 * 
 * @author mineichen
 */
class MineichenTest extends TestCase {

	/**
	 * @var \RemoteWebDriver
	 */
	private $webDriver;

	private $url = 'http://nginx';
	
	
	public function setUp()
	{
		$capabilities = array(WebDriverCapabilityType::BROWSER_NAME => 'chrome');
		$this->webDriver = RemoteWebDriver::create('http://172.18.3:4444/wd/hub', $capabilities);
	}

	public function testHelloPageContainsName()
	{
		$page = $this->webDriver->get($this->url . "/hello/World");
		$el = $this->webDriver->findElement(WebDriverBy::id('greeting-name'));
		$this->assertEquals("World", $el->getText());	
	    $this->assertContains('Hello', $this->webDriver->getTitle());
	    
	    $this->webDriver->findElement(WebDriverBy::cssSelector("body a"))->click();
	    $this->assertContains("https://www.google.ch", $this->webDriver->getCurrentUrl());
	}

}
