<?php

namespace Tests\MailChimp;

use Magium\AbstractTestCase;
use Magium\MailChimp\Actions\MailChimp\LogIn;
use Magium\MailChimp\Extractors\MailChimp\SubscriberDetails;
use Magium\MailChimp\Navigators\MailChimp\MainNavigation;
use Magium\MailChimp\Navigators\MailChimp\Subscriber;
use Magium\MailChimp\Navigators\MailChimp\SubscriberList;

class ExtractorTest extends AbstractTestCase
{

    public function testNavigateToList()
    {
        $this->getAction(LogIn::ACTION)->execute();
        $this->getNavigator(MainNavigation::NAVIGATOR)->navigateTo('Lists');
        $this->getNavigator(SubscriberList::NAVIGATOR)->navigateTo('Magium');
        $this->getNavigator(Subscriber::NAVIGATOR)->navigateTo('kschroeder@mirageworks.com');
        $extractor = $this->getExtractor(SubscriberDetails::EXTRACTOR);
        /* @var $extractor SubscriberDetails */

        $extractor->extract();
        // Note, this test was built using the Magium MailChimp account.  Do not expect these tests to work for you.

        self::assertEquals('kschroeder@mirageworks.com', $extractor->getEmailAddress());
        self::assertEquals('Kevin', $extractor->getFirstName());
        self::assertEquals('Schroeder', $extractor->getLastName());
        self::assertNotNull($extractor->getCustomerGroups());
        self::assertNotNull($extractor->getProfileUpdated());
        self::assertNotNull($extractor->getTimeZone());
        self::assertNotNull($extractor->getSignupSource());
        self::assertNotNull($extractor->getLanguage());

    }

}