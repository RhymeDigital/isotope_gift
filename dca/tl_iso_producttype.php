<?php

/**
 * Copyright (C) 2015 Rhyme Digital, LLC.
 * 
 * @author		Blair Winans <blair@rhyme.digital>
 * @author		Adam Fisher <adam@rhyme.digital>
 * @link		http://rhyme.digital
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */



/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_iso_producttype']['palettes']['gift']			= $GLOBALS['TL_DCA']['tl_iso_producttype']['palettes']['standard'];


/**
 * Fields
 */
array_splice($GLOBALS['TL_DCA']['tl_iso_producttype']['fields']['attributes']['load_callback'], 0, 0, array(array('Rhyme\Backend\ProductType\GiftAttributeWizard', 'load')));
