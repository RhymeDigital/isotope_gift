<?php

/**
 * Copyright (C) 2015 Rhyme Digital, LLC.
 * 
 * @author		Blair Winans <blair@rhyme.digital>
 * @author		Adam Fisher <adam@rhyme.digital>
 * @link		http://rhyme.digital
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Rhyme\Hooks\CalculatePrice;

use Isotope\Interfaces\IsotopePrice;
use Rhyme\Model\Gift as GiftProduct;


class CalculateGiftProductPrice extends \Frontend
{
	
	/**
	 * Calculate the price of a gift product
	 * 
	 * Namespace:	Isotope
	 * Class:		Isotope
	 * Method:		calculatePrice
	 * Hook:		$GLOBALS['ISO_HOOKS']['calculatePrice']
	 *
	 * @access		public
	 * @param		mixed
	 * @return		void
	 */
	public function run($fltPrice, $objSource, $strField, $intTaxClass, $arrOptions)
	{
		if ( !($objSource instanceof IsotopePrice) ||  
		     ($strField != 'price' && $strField != 'low_price') ||
		     !is_array($arrOptions) ||
		     !$arrOptions['gift_amount']
        )
		{
			return $fltPrice;
		}
		
        $fltPrice += floatval($arrOptions['gift_amount']);
		return $fltPrice;
	}
}