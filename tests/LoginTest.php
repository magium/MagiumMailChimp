<?php

namespace Tests\MailChimp;

use Magium\AbstractTestCase;
use Magium\MailChimp\Actions\MailChimp\LogIn;

class LoginTest extends AbstractTestCase
{

    public function testLogin()
    {
        $this->getAction(LogIn::ACTION)->execute();
    }

}