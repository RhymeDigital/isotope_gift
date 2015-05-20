<?php

/**
 * Copyright (C) 2015 Rhyme Digital, LLC.
 * 
 * @author		Blair Winans <blair@rhyme.digital>
 * @author		Adam Fisher <adam@rhyme.digital>
 * @link		http://rhyme.digital
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Rhyme\Backend\ProductType;


class GiftAttributeWizard extends \Backend
{

    /**
     * Allow or disallow gift_amount field
     *
     * @param mixed  $varValue The widget value
     * @param object $dc       The DataContainer object
     *
     * @return array
     */
    public function load($varValue, $dc)
    {
    	if ($dc && $dc->activeRecord && $dc->activeRecord->class)
    	{
	        $this->loadDataContainer('tl_iso_product');
	        
	        if ($dc->activeRecord->class != 'gift')
	        {
		        unset($GLOBALS['TL_DCA']['tl_iso_product']['fields']['gift_amount']);
	        }
        }

        return $varValue;
    }
}