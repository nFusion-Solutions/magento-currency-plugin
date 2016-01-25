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
 * CurrencyExchangeRate model
 *
 * @category    Nfusionsolutions
 * @package     Nfusionsolutions_CurrencyExchangeRates
 */
class Nfusionsolutions_CurrencyExchangeRates_Model_Currencyexchangerate extends Mage_Directory_Model_Currency_Import_Abstract
{
    
    protected $_messages = array(); 
 
    public function _convert($currencyFrom, $currencyTo, $retry=0) {		
		 
		$_helper = Mage::helper('nfusionsolutions_currencyexchangerates');
		
		try { 
			$url_call = $_helper->getApiUrl($currencyFrom, $currencyTo);    
			 
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, $url_call); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 ); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json',	'Content-Type: application/json','Cache-Control: no-cache','Pragma: no-cache'));  
			$result = curl_exec($ch); 
			curl_close($ch); 
			
			//Decode the API response
			$rateData = json_decode($result); 
			//echo '<pre>';print_r($rateData);die;
			$api_type = $_helper->getApiType();
			if($api_type == 'daily_rates'){
				$rate = $rateData->rate;
			}elseif($api_type == 'intraday_rates'){
				$rate = $rateData[0]->data->rate;
			} 
			if(count($rateData) > 0){
				return (float) $rate;	
			}else{  
				if($_helper->checkLog()){
					$msg = 'Currency import failed due to wrong key. Cannot retrieve rate from '.$currencyFrom.' to '.$currencyTo;
					Mage::log($msg, null, 'currency_import.log'); 
				} 
				$this -> _messages[] = Mage::helper('directory') -> __('Cannot retrieve rate from %s', $currencyFrom.' to '.$currencyTo.' due to invalid key.');
			}
		} catch (Exception $e) {
			$this -> _messages[] = Mage::helper('directory') -> __('Cannot retrieve rate from %s.', $this -> _url);
		}
    }    
} 