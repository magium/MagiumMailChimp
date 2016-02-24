<?php

namespace Tests\MailChimp;

use Magium\AbstractTestCase;
use Magium\MailChimp\Actions\MailChimp\LogIn;
use Magium\MailChimp\Assertions\MailChimp\NotSubscribed;
use Magium\MailChimp\Assertions\MailChimp\Subscribed;
use Magium\MailChimp\Navigators\MailChimp\MainNavigation;
use Magium\MailChimp\Navigators\MailChimp\Subscriber;
use Magium\MailChimp\Navigators\MailChimp\SubscriberList;

class AssertSubscriberTest extends AbstractTestCase
{

    public function testIsSubscribedTest()
    {
        $assertion = $this->getAssertion(Subscribed::ASSERTION);
        /* @var $assertion Subscribed */
        $assertion->setEmail('kschroeder@mirageworks.com');
        $assertion->setList('Magium');
        self::assertTrue($assertion->assert());
    }

    public function testNotSubscribedTest()
    {
        $assertion = $this->getAssertion(NotSubscribed::ASSERTION);
        /* @var $assertion Subscribed */
        $assertion->setEmail('boogers@mirageworks.com');
        $assertion->setList('Magium');
        self::assertTrue($assertion->assert());
    }

}