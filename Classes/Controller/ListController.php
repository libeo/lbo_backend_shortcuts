<?php

namespace Libeo\LboBackendShortcuts\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Routing\UriBuilder as BackendUriBuilder;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;

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
    public function __construct(
        private readonly BackendUriBuilder $backendUriBuilder
    ) {
    }

    public function processRequest(RequestInterface $request): ResponseInterface
    {
        $tsConfig = BackendUtility::getPagesTSconfig(0);
        $modules = $tsConfig['moduleShortcutLinks.'];
        $configShortcut = $modules[$request->getArgument('action') . '.'];

        $urlParameters = [];
        foreach(($configShortcut['urlParameters.'] ?? []) as $name => $value) {
            $urlParameters[$name] = $value;
        }
        $redirectUrl = (string) $this->backendUriBuilder->buildUriFromRoute($configShortcut['moduleTarget'], $urlParameters);

        return new RedirectResponse($redirectUrl);
    }
}
