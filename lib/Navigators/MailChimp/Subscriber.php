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
    protected $subscribed;

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

    public function isSubscribed()
    {
        return $this->subscribed;
    }

    public function navigateTo($emailAddress)
    {
        $this->webDriver->byXpath($this->theme->getListSearchSelectXpath())->click();
        $element = $this->webDriver->byXpath($this->theme->getListSearchSearchInputXpath());
        $this->webDriver->wait()->until(ExpectedCondition::visibilityOf($element));
//        $this->testCase->sleep('1s'); // Give the animation time...
        $count = 0;
        while (true) {
            try {
                $element->clear()->sendKeys($emailAddress);
                $this->webDriver->byXpath($this->theme->getListSearchSubmitXpath())->click();

                $this->webDriver->wait(5)->until(ExpectedCondition::elementExists($this->theme->getListSearchViewProfileLinkXpath(), WebDriver::BY_XPATH));
                $element = $this->webDriver->byXpath($this->theme->getListSearchViewProfileLinkXpath());
                $this->webDriver->wait(5)->until(ExpectedCondition::visibilityOf($element));
                $this->subscribed = !$this->webDriver->elementDisplayed($this->theme->getUnsubscribedSearchResultXpath(), WebDriver::BY_XPATH);
                break;
            } catch (\Exception $e) {
                if ($count++ > 6) {
                    throw new SubscriberNotFoundException('The subscriber could not be found: ' . $emailAddress);
                } else {
                    $this->testCase->sleep('10s');
                }
            }
        }
        $body = $this->webDriver->byXpath('//body');
        $element->click();

        $this->loaded->execute($body);
    }
}