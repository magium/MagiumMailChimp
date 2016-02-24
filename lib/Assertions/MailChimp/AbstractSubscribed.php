<?php

namespace Magium\MailChimp\Assertions\MailChimp;

use Magium\Assertions\AbstractAssertion;
use Magium\InvalidConfigurationException;
use Magium\MailChimp\Actions\MailChimp\LogIn;
use Magium\MailChimp\Navigators\MailChimp\MainNavigation;
use Magium\MailChimp\Navigators\MailChimp\Subscriber;
use Magium\MailChimp\Navigators\MailChimp\SubscriberList;
use Magium\MailChimp\Themes\MailChimp as Theme;

abstract class AbstractSubscribed extends AbstractAssertion
{

    protected $theme;
    protected $login;
    protected $mainNavigation;
    protected $email;
    protected $list;
    protected $listNavigation;
    protected $subscriber;

    public function __construct(
        Theme $theme,
        LogIn $logIn,
        MainNavigation $navigation,
        SubscriberList $subscriberList,
        Subscriber  $subscriber
    )
    {
        $this->theme        = $theme;
        $this->login        = $logIn;
        $this->mainNavigation   = $navigation;
        $this->listNavigation = $subscriberList;
        $this->subscriber   = $subscriber;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setList($list)
    {
        $this->list = $list;
    }

    protected abstract function finalize();


    public function assert()
    {

        if (!$this->email || !$this->list) {
            throw new InvalidConfigurationException('Missing either the email, the list or both');
        }

        $this->login->execute();
        $this->mainNavigation->navigateTo('Lists');
        $this->listNavigation->navigateTo($this->list);

        return $this->finalize();
    }
}