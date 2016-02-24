<?php

namespace Magium\MailChimp\Actions\MailChimp;

use Magium\MailChimp\Themes\MailChimp;
use Magium\WebDriver\WebDriver;

class WaitForPageLoaded extends \Magium\Actions\WaitForPageLoaded
{
    const ACTION = 'MailChimp\WaitForPageLoaded';

    public function __construct(WebDriver $webDriver, MailChimp $themeConfiguration)
    {
        parent::__construct($webDriver, $themeConfiguration);
    }

}