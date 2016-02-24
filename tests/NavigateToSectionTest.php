<?php

namespace Tests\MailChimp;

use Magium\AbstractTestCase;
use Magium\MailChimp\Actions\MailChimp\LogIn;
use Magium\MailChimp\Navigators\MailChimp\MainNavigation;

class NavigateToSectionTest extends AbstractTestCase
{

    public function testNavigateToSection()
    {
        $this->getAction(LogIn::ACTION)->execute();
        $this->getNavigator(MainNavigation::NAVIGATOR)->navigateTo('Lists');
    }

}