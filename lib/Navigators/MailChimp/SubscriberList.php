<?php

namespace Magium\MailChimp\Navigators\MailChimp;


use Magium\MailChimp\Actions\MailChimp\WaitForPageLoaded;
use Magium\MailChimp\Themes\MailChimp as Theme;
use Magium\WebDriver\WebDriver;

class SubscriberList
{
    const NAVIGATOR = 'MailChimp\SubscriberList';

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

    public function navigateTo($list)
    {
        $body = $this->webDriver->byXpath('//body');
        $this->webDriver->byXpath($this->theme->getListSelectXpath($list))->click();
        $this->loaded->execute($body);
    }

}