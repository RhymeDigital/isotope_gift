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
 * Table tl_iso_product
 */
$GLOBALS['TL_DCA']['tl_iso_product']['fields']['gift_amount'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_iso_product']['gift_amount'],
    'exclude'               => true,
    'search'                => true,
    'sorting'               => true,
    'inputType'             => 'text',
    'eval'                  => array('mandatory'=>true, 'maxlength'=>13, 'rgxp'=>'price'),
    'attributes'            => array('legend'=>'pricing_legend', 'fixed'=>true, 'customer_defined'=>true),
    'sql'                   => "decimal(12,2) NOT NULL default '0.00'",
);

