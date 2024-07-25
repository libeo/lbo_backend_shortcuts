<?php

namespace Libeo\LboBackendShortcuts\Controller;

use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Backend\Utility\BackendUtility;

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
class ListController extends ActionController
{
    public function processRequest(RequestInterface $request): ResponseInterface
    {
        $tsConfig = BackendUtility::getPagesTSconfig(0);
        $modules = $tsConfig['moduleShortcutLinks.'];
        $configShortcut = $modules[$request->getArgument('action') . '.'];


        $uriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
        $urlParameters = [];
        foreach($configShortcut['urlParameters.'] as $name => $value) {
            $urlParameters[$name] = $value;
        }
        $redirectUrl = (string) $uriBuilder->buildUriFromRoute($configShortcut['moduleTarget'], $urlParameters);

        return new RedirectResponse($redirectUrl);
    }
}
