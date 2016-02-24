<?php

namespace Magium\MailChimp\Assertions\MailChimp;

class Subscribed extends AbstractSubscribed
{
    const ASSERTION = 'MailChimp\Subscribed';

    public function finalize()
    {
        $this->subscriber->navigateTo($this->email);
        return true;
    }

}