<?php

namespace Tests\MailChimp;

use Magium\AbstractTestCase;
use Magium\MailChimp\Actions\MailChimp\LogIn;
use Magium\MailChimp\Navigators\MailChimp\MainNavigation;
use Magium\MailChimp\Navigators\MailChimp\Subscriber;
use Magium\MailChimp\Navigators\MailChimp\SubscriberList;

class NavigateToSubscriberTest extends AbstractTestCase
{

    public function testNavigateToList()
    {
        $this->getAction(LogIn::ACTION)->execute();
        $this->getNavigator(MainNavigation::NAVIGATOR)->navigateTo('Lists');
        $this->getNavigator(SubscriberList::NAVIGATOR)->navigateTo('Magium');
        $this->getNavigator(Subscriber::NAVIGATOR)->navigateTo('kschroeder@mirageworks.com');
    }

}