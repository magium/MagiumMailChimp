<?php

namespace Magium\MailChimp\Navigators\MailChimp;

use Magium\AbstractTestCase;
use Magium\MailChimp\Actions\MailChimp\WaitForPageLoaded;
use Magium\MailChimp\Themes\MailChimp as Theme;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class Subscriber
{
    const NAVIGATOR = 'MailChimp\Subscriber';

    protected $webDriver;
    protected $theme;
    protected $loaded;
    protected $testCase;

    public function __construct(
        WebDriver $webDriver,
        Theme     $theme,
        WaitForPageLoaded $loaded,
        AbstractTestCase $testCase
    ) {
        $this->webDriver    = $webDriver;
        $this->theme        = $theme;
        $this->loaded       = $loaded;
        $this->testCase     = $testCase;
    }

    public function navigateTo($emailAddress)
    {
        $this->webDriver->byXpath($this->theme->getListSearchSelectXpath())->click();
        $element = $this->webDriver->byXpath($this->theme->getListSearchSearchInputXpath());
        $this->webDriver->wait()->until(ExpectedCondition::visibilityOf($element));
//        $this->testCase->sleep('1s'); // Give the animation time...
        $element->clear()->sendKeys($emailAddress);
        $this->webDriver->byXpath($this->theme->getListSearchSubmitXpath())->click();
        try {
            $this->webDriver->wait(5)->until(ExpectedCondition::elementExists($this->theme->getListSearchViewProfileLinkXpath(), WebDriver::BY_XPATH));
            $element = $this->webDriver->byXpath($this->theme->getListSearchViewProfileLinkXpath());
            $this->webDriver->wait(5)->until(ExpectedCondition::visibilityOf($element));
        } catch (\Exception $e) {
            throw new SubscriberNotFoundException('The subscriber could not be found: ' . $emailAddress);
        }
        $body = $this->webDriver->byXpath('//body');
        $element->click();

        $this->loaded->execute($body);
    }
}