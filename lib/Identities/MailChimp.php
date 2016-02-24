<?php

namespace Magium\MailChimp\Identities;

use Magium\AbstractConfigurableElement;

class MailChimp extends AbstractConfigurableElement
{

    public $username;

    public $password;

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }



}