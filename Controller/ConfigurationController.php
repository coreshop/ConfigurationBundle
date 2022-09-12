<?php
declare(strict_types=1);

/*
 * CoreShop
 *
 * This source file is available under two different licenses:
 *  - GNU General Public License version 3 (GPLv3)
 *  - CoreShop Commercial License (CCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 *
 */

namespace CoreShop\Bundle\ConfigurationBundle\Controller;

use CoreShop\Bundle\ResourceBundle\Controller\ResourceController;
use CoreShop\Component\Configuration\Service\ConfigurationServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigurationController extends ResourceController
{
    public function saveAllAction(Request $request): Response
    {
        $values = $this->getParameterFromRequest($request, 'values');
        $values = array_htmlspecialchars($values);

        foreach ($values as $key => $value) {
            $this->getConfigurationService()->set($key, $value);
        }

        return $this->viewHandler->handle(['success' => true]);
    }

    private function getConfigurationService(): ConfigurationServiceInterface
    {
        return $this->get(ConfigurationServiceInterface::class);
    }
}
