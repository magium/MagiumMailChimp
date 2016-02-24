<?php

namespace Magium\MailChimp\Extractors\MailChimp;

use Magium\AbstractTestCase;
use Magium\Extractors\AbstractExtractor;
use Magium\MailChimp\Themes\MailChimp;
use Magium\WebDriver\WebDriver;

class SubscriberDetails extends AbstractExtractor
{
    const EXTRACTOR = 'MailChimp\SubscriberDetails';

    protected $emailAddress;
    protected $firstName;
    protected $lastName;
    protected $customerGroups;
    protected $profileUpdated;
    protected $timeZone;
    protected $signupSource;
    protected $language;

    public function __construct(WebDriver $webDriver, AbstractTestCase $testCase, MailChimp $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }


    /**
     * @return mixed
     */
    public function getCustomerGroups()
    {
        return $this->customerGroups;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getProfileUpdated()
    {
        return $this->profileUpdated;
    }

    /**
     * @return mixed
     */
    public function getSignupSource()
    {
        return $this->signupSource;
    }

    /**
     * @return mixed
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }



    public function extract()
    {
        $items = [
            'emailAddress'      => 'Email Address *',
            'firstName'         => 'First Name',
            'lastName'          => 'Last Name',
            'customerGroups'    => 'Customer Groups',
            'profileUpdated'    => 'Profile updated',
            'timeZone'          => 'Time zone',
            'signupSource'      => 'Signup source',
            'language'          => 'Language',
        ];
        foreach ($items as $property => $selector) {
            try {
                $selector = $this->theme->getSubscriberDetailsSelectorXpath($selector);
                $this->$property = trim($this->webDriver->byXpath($selector)->getText());
            } catch (\Exception $e) {
                // continue
            }
        }
    }
}