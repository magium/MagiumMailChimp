<?php

namespace Magium\MailChimp\Navigators\MailChimp;


use Magium\MailChimp\Actions\MailChimp\WaitForPageLoaded;
use Magium\MailChimp\Themes\MailChimp as Theme;
use Magium\WebDriver\WebDriver;

class MainNavigation
{
    const NAVIGATOR = 'MailChimp\MainNavigation';

    protected $webDriver;
    protected $theme;
    protected $loaded;

    public function __construct(
        WebDriver $webDriver,
        Theme $theme,
        WaitForPageLoaded $loaded
    )
    {
        $this->webDriver = $webDriver;
        $this->theme     = $theme;
        $this->loaded    = $loaded;
    }

    public function navigateTo($menuItem)
    {
        $body = $this->webDriver->byXpath('//body');
        $this->webDriver->byXpath($this->theme->getMenuItemSelectXpath($menuItem))->click();
        $this->loaded->execute($body);
    }

}