<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  terminal42 gmbh 2013
 * @license    LGPL
 */

namespace NotificationCenter\Model;

use NotificationCenter\BagType\BagTypeInterface;
use NotificationCenter\Gateway\GatewayInterface;

class Gateway extends \Isotope\Model\TypeAgent
{

    /**
     * Name of the current table
     * @var string
     */
    protected static $strTable = 'tl_nc_gateway';

    /**
     * Interface to validate gateway
     * @var string
     */
    protected static $strInterface = '\NotificationCenter\Model\Gateway\GatewayInterface';

    /**
     * List of types (classes) for this model
     * @var array
     */
    protected static $arrModelTypes = array();
}