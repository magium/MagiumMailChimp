<?php

namespace Magium\MailChimp\Actions\MailChimp;

use Magium\AbstractTestCase;
use Magium\MailChimp\Identities\MailChimp as Identity;
use Magium\MailChimp\Themes\MailChimp as Theme;
use Magium\WebDriver\WebDriver;

class LogIn
{
    const ACTION = 'MailChimp\LogIn';

    protected $webDriver;
    protected $identity;
    protected $theme;
    protected $testCase;
    protected $loaded;

    public function __construct(
        WebDriver $webDriver,
        Identity $identity,
        Theme $theme,
        AbstractTestCase $testCase,
        WaitForPageLoaded $loaded
    )
    {
        $this->webDriver    = $webDriver;
        $this->identity     = $identity;
        $this->theme        = $theme;
        $this->testCase     = $testCase;
        $this->loaded       = $loaded;
    }

    public function execute()
    {
        if ($this->webDriver->elementExists($this->theme->getMenuItemSelectXpath('Lists'), WebDriver::BY_XPATH)) {
            return;
        }
        $this->testCase->commandOpen($this->theme->getHomeUrl());
        $body = $this->webDriver->byXpath('//body');
        $this->webDriver->byXpath($this->theme->getLogInButtonXpath())->click();
        $this->loaded->execute($body);

        $this->webDriver->byXpath($this->theme->getUsernameXpath())->clear()->sendKeys(
            $this->identity->getUsername()
        );
        $this->webDriver->byXpath($this->theme->getPasswordXpath())->clear()->sendKeys(
            $this->identity->getPassword()
        );

        $body = $this->webDriver->byXpath('//body');

        $this->webDriver->byXpath($this->theme->getLoginSubmitButtonXpath())->click();
        $this->loaded->execute($body);
    }

}