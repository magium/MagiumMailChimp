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
        } catch (SubscriberNotFoundException $e) {
            return true;
        }
        return false;
    }

}