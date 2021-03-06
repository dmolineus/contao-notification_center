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
 * @copyright  terminal42 gmbh 2014
 * @license    LGPL
 */

namespace NotificationCenter\Model;

use NotificationCenter\Gateway\GatewayInterface;

class Gateway extends \Model
{

    /**
     * Name of the current table
     * @var string
     */
    protected static $strTable = 'tl_nc_gateway';

    /**
     * Gateway instance
     * @var GatewayInterface
     */
    protected $objGateway;


    /**
     * Get gateway instance
     * @return  GatewayInterface|null
     */
    public function getGateway()
    {
        // We only need to build the gateway once, Model is cached by registry and Gateway does not change between messages
        if (null === $this->objGateway) {
            $strClass = $GLOBALS['NOTIFICATION_CENTER']['GATEWAY'][$this->type];
            if (!class_exists($strClass)) {
                \System::log(sprintf('Could not find gateway class "%s".', $strClass), __METHOD__, TL_ERROR);

                return null;
            }

            try {
                $objGateway = new $strClass($this);

                if (!$objGateway instanceof GatewayInterface) {
                    \System::log(sprintf('The gateway class "%s" must be an instance of GatewayInterface.', $strClass), __METHOD__, TL_ERROR);

                    return null;
                }

                $this->objGateway = $objGateway;

            } catch (\Exception $e) {
                \System::log(sprintf('There was a general error building the gateway: "%s".', $e->getMessage()), __METHOD__, TL_ERROR);

                return null;
            }
        }

        return $this->objGateway;
    }
}
