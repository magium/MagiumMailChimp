<?php

namespace Magium\MailChimp\Assertions\MailChimp;

class Subscribed extends AbstractSubscribed
{
    const ASSERTION = 'MailChimp\Subscribed';

    public function finalize()
    {
        try {
            $this->subscriber->navigateTo($this->email);
            return true;
        } catch (\Exception $e) {
            $this->testCase->fail('The email address is not subscribed: ' . $this->email);
        }
    }

}