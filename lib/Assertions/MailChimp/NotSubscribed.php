<?php

namespace Magium\MailChimp\Assertions\MailChimp;

use Magium\MailChimp\Navigators\MailChimp\SubscriberNotFoundException;

class NotSubscribed extends AbstractSubscribed
{
    const ASSERTION = 'MailChimp\NotSubscribed';

    public function finalize()
    {
        try {
            $this->subscriber->navigateTo($this->email);
            $this->testCase->assertFalse($this->subscriber->isSubscribed());
            if ($this->subscriber->isSubscribed()) {
                $this->testCase->fail('The email address is subscribed: ' . $this->email);
            }
        } catch (SubscriberNotFoundException $e) {
        }
        return true;
    }

}