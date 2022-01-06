<?php

namespace Libeo\LboBackendShortcuts\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\ResponseInterface;

/***
 *
 * This file is part of the "Formation TODO" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Pierre Boivin <pierre.boivin@libeo.com>, Libéo
 *
 ***/
class ListController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    public function processRequest(RequestInterface $request, ResponseInterface $response)
    {
        $tsConfig = \TYPO3\CMS\Backend\Utility\BackendUtility::getPagesTSconfig(0);
        $modules = $tsConfig['moduleShortcutLinks.'];
        $configShortcut = $modules[$request->getControllerActionName() . '.'];


        $uriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);
        $urlParameters = [];
        foreach($configShortcut['urlParameters.'] as $name => $value) {
            $urlParameters[$name] = $value;
        }
        $redirectUrl = (string) $uriBuilder->buildUriFromRoute($configShortcut['moduleTarget'], $urlParameters);

        $this->request = $request;
        $this->request->setDispatched(true);
        $this->response = $response;
        $this->redirectToUri($redirectUrl);
    }
}