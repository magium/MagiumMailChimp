<?php

namespace Magium\MailChimp\Themes;

use Magium\AbstractConfigurableElement;
use Magium\Themes\ThemeConfigurationInterface;

class MailChimp extends AbstractConfigurableElement implements ThemeConfigurationInterface
{

    const THEME = 'MailChimp';

    public $guaranteedPageLoadedElementDisplayedXpath = '//a[@class="textcolor" and .="Terms"]';

    public $homeUrl = 'http://mailchimp.com/';

    public $logInButtonXpath = '//a[@aria-label="Log In"]';

    public $usernameXpath = '//input[@id="username"]';

    public $passwordXpath = '//input[@id="password"]';

    public $loginSubmitButtonXpath = '//button[@type="submit" and @value="log in"]';

    public $menuItemSelectXpath = '//div[@role="navigation" and contains(concat(" ",normalize-space(@class)," ")," main-navigation ")]/descendant::nav[1]/ul/li[.="%s"]';

    public $listSelectXpath = '//a[@title="List name" and .="%s"]';

    public $listSearchSelectXpath = '//a[@data-menubar-item="searchLink"]';

    public $listSearchSearchInputXpath = '//input[@id="global-search"]';

    public $listSearchSubmitXpath = '//form[@id="main-search"]/descendant::button[@data-dojo-attach-point="searchIcon"]';

    public $listSearchViewProfileLinkXpath = '//div[@id="search-results-data"]/descendant::li/descendant::a[@title="View subscriber profile"]';

    public $subscriberDetailsSelectorXpath = '//ul[@class="dotted-list"]/descendant::p[contains(concat(" ",normalize-space(@class)," ")," fwb ") and .="%s"]/../p[2]';

    public $unsubscribedSearchResultXpath = '//div[@id="search-results-data"]/descendant::span[.="Unsubscribed"]';

    /**
     * @return string
     */
    public function getUnsubscribedSearchResultXpath()
    {
        return $this->unsubscribedSearchResultXpath;
    }

    

    /**
     * @return string
     */
    public function getSubscriberDetailsSelectorXpath($detail)
    {
        return sprintf($this->subscriberDetailsSelectorXpath, $detail);
    }



    /**
     * @return string
     */
    public function getListSearchViewProfileLinkXpath()
    {
        return $this->listSearchViewProfileLinkXpath;
    }



    /**
     * @return string
     */
    public function getUsernameXpath()
    {
        return $this->usernameXpath;
    }

    /**
     * @return string
     */
    public function getHomeUrl()
    {
        return $this->homeUrl;
    }

    /**
     * @return string
     */
    public function getListSearchSearchInputXpath()
    {
        return $this->listSearchSearchInputXpath;
    }

    /**
     * @return string
     */
    public function getListSearchSelectXpath()
    {
        return $this->listSearchSelectXpath;
    }

    /**
     * @return string
     */
    public function getListSearchSubmitXpath()
    {
        return $this->listSearchSubmitXpath;
    }

    /**
     * @return string
     */
    public function getListSelectXpath($list)
    {
        return sprintf($this->listSelectXpath, $list);
    }

    /**
     * @return string
     */
    public function getLogInButtonXpath()
    {
        return $this->logInButtonXpath;
    }

    /**
     * @return string
     */
    public function getLoginSubmitButtonXpath()
    {
        return $this->loginSubmitButtonXpath;
    }

    /**
     * @return string
     */
    public function getMenuItemSelectXpath($menuItem)
    {
        return sprintf($this->menuItemSelectXpath, $menuItem);
    }

    /**
     * @return string
     */
    public function getPasswordXpath()
    {
        return $this->passwordXpath;
    }



    public function getGuaranteedPageLoadedElementDisplayedXpath()
    {
        return $this->guaranteedPageLoadedElementDisplayedXpath;
    }

    public function setGuaranteedPageLoadedElementDisplayedXpath($xpath)
    {
        $this->guaranteedPageLoadedElementDisplayedXpath = $xpath;
    }

}