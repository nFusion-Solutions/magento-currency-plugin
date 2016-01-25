<?php
/**
 * Nfusionsolutions_CurrencyExchangeRates extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Nfusionsolutions
 * @package        Nfusionsolutions_CurrencyExchangeRates
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * CurrencyExchangeRates default helper
 *
 * @category    Nfusionsolutions
 * @package     Nfusionsolutions_CurrencyExchangeRates 
 */
class Nfusionsolutions_CurrencyExchangeRates_Helper_Data extends Mage_Core_Helper_Abstract
{

	protected $api_base_url = 'https://service.nfusionsolutions.biz/';
	  
    /**
     * Prepare API url
     * @access public
     * @param $currencyFrom and $currencyTo
     */	 
	public function getApiUrl($currencyFrom, $currencyTo)
    {
        $api_type = $this->getApiType();
		$api_call = '';
		
		if($api_type == 'daily_rates'){
			$api_call = $this->api_base_url.'currencies/rate?token='.$this->getToken().'&from='.$currencyFrom.'&to='.$currencyTo;
		}elseif($api_type == 'intraday_rates'){
			$api_call = $this->api_base_url.'api/Currencies/CurrencyMidRates?token='.$this->getToken().'&pairs=[{Base:'.$currencyFrom.',Counter:'.$currencyTo.'}]';
		}
		//echo $api_call;die;
		return $api_call;
    }
	
    /**
     * Get config data
     * @access public
     * @param none
     */	 
	public function getApiType()
    {
       return Mage::getStoreConfig('currencyexchangerates/currencyexchangerates/api_type');
    } 
	
    /**
     * Get config data
     * @access public
     * @param none
     */
	public function getToken()
    {
        return Mage::getStoreConfig('currencyexchangerates/currencyexchangerates/token');
    }

    /**
     * Get config data
     * @access public
     * @param none
     */
	public function checkLog()
    {
        return Mage::getStoreConfig('dev/log/active');
    }    
	
}
