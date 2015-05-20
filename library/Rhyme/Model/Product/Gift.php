<?php

/**
 * Copyright (C) 2015 Rhyme Digital, LLC.
 * 
 * @author		Blair Winans <blair@rhyme.digital>
 * @author		Adam Fisher <adam@rhyme.digital>
 * @link		http://rhyme.digital
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Rhyme\Model\Product;

use Haste\Units\Mass\WeightAggregate;

use Isotope\Isotope;
use Isotope\Model\Product as ProductModel;
use Isotope\Model\Product\Standard as StandardProduct;
use Isotope\Interfaces\IsotopeProduct;
use Isotope\Interfaces\IsotopeProductCollection;
use Isotope\Model\ProductPrice;


/**
 * Class Gift
 */
class Gift extends StandardProduct implements IsotopeProduct, WeightAggregate
{

    /**
     * Returns true if the product is available
     * ALMOST THE SAME AS THE PARENT, EXCEPT WE DON'T CHECK FOR PRICE
     *
     * @param IsotopeProductCollection|\Isotope\Model\ProductCollection $objCollection
     *
     * @return bool
     */
    public function isAvailableForCollection(IsotopeProductCollection $objCollection)
    {
        if ($objCollection->isLocked()) {
            return true;
        }

        if (BE_USER_LOGGED_IN !== true && !$this->isPublished()) {
            return false;
        }

        // Show to guests only
        if ($this->arrData['guests'] && $objCollection->member > 0 && BE_USER_LOGGED_IN !== true && !$this->arrData['protected']) {
            return false;
        }

        // Protected product
        if (BE_USER_LOGGED_IN !== true && $this->arrData['protected']) {
            if ($objCollection->member == 0) {
                return false;
            }

            $groups       = deserialize($this->arrData['groups']);
            $memberGroups = deserialize($objCollection->getRelated('member')->groups);

            if (!is_array($groups) || empty($groups) || !is_array($memberGroups) || empty($memberGroups) || !count(array_intersect($groups, $memberGroups))) {
                return false;
            }
        }

        // Check that the product is in any page of the current site
        if (count(\Isotope\Frontend::getPagesInCurrentRoot($this->getCategories(), $objCollection->getRelated('member'))) == 0) {
            return false;
        }

        // Check if "advanced price" is available
        //if (null === $this->getPrice($objCollection) && (in_array('price', $this->getAttributes()) || $this->hasVariantPrices())) {
        //    return false;
        //}

        return true;
    }


    /**
     * Return a widget object based on a product attribute's properties
     * @param   string
     * @param   boolean
     * @return  string
     */
    protected function generateProductOptionWidget($strField, &$arrVariantOptions, &$arrAjaxOptions)
    {
    	\Controller::loadDataContainer(ProductModel::getTable());
        $GLOBALS['TL_DCA'][ProductModel::getTable()]['fields']['gift_amount']['default'] = 
        	$GLOBALS['TL_DCA'][ProductModel::getTable()]['fields']['gift_amount']['default'] ?: Isotope::formatPrice($this->getPrice()->getAmount());
        
        return parent::generateProductOptionWidget($strField, $arrVariantOptions, $arrAjaxOptions);
    }


}