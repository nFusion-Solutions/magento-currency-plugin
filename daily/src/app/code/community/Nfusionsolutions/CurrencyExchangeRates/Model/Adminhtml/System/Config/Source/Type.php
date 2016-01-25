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
 * CurrencyExchangeRates setup
 *
 * @category    Nfusionsolutions
 * @package     Nfusionsolutions_CurrencyExchangeRates 
 */
class Nfusionsolutions_CurrencyExchangeRates_Model_Adminhtml_System_Config_Source_Type
{
   public function toOptionArray()
   {
       $themes = array(
           array('value' => 'daily_rates', 'label' => 'Daily rates'),
           array('value' => 'intraday_rates', 'label' => 'Intraday rates'), 
       ); 
       return $themes;
   }
}