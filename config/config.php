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
 * Product classes
 */
\Isotope\Model\Product::registerModelType('gift', 'Rhyme\Model\Product\Gift');


/**
 * Hooks
 */
$GLOBALS['ISO_HOOKS']['calculatePrice'][] = array('Rhyme\Hooks\CalculatePrice\CalculateGiftProductPrice', 'run');