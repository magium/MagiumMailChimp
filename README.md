# MagiumMailChimp
A Magium module for validating MailChimp integration.  Note - this is a community project; it is not supported by Mailchimp

More information can be found at [Magiumlib.com](http://magiumlib.com/)

## Installation

```
composer require magium/mailchimp
```

## Configuration

The MailChimp identity component is an `AbstractConfigurableElement` which means that its properties can be changed.  To change the properties create a `MailChimp.php` file in your project's `/configuration/Magium/MailChimp/Identities` directory.

```
<?php

$this->username = 'my username';
$this->password = 'my password';

```

## Usage

There are two primary ways of using it

1. Assert that an email address is subscribed
2. Retrieve a subscriber's information

### Asserting Subscription

```

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
        $assertion->assert();
    }

    public function testNotSubscribedTest()
    {
        $assertion = $this->getAssertion(NotSubscribed::ASSERTION);
        /* @var $assertion Subscribed */
        $assertion->setEmail('boogers@mirageworks.com');
        $assertion->setList('Magium');
        $assertion->assert();
    }

}
```

### Extracting Subscriber Information

```

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

    }

}
```