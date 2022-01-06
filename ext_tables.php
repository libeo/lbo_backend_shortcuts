<?php

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        if (TYPO3_MODE === 'BE') {
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule(
                'shortcuts',
                '',
                'after:web',
                null,
                [
                    'name' => 'shortcuts',
                    'labels' => 'LLL:EXT:lbo_backend_shortcuts/Resources/Private/Language/locallang_mod.xlf',
                    'iconIdentifier' => 'actions-wizard-link'
                ]
            );

            $tsConfig = \TYPO3\CMS\Backend\Utility\BackendUtility::getPagesTSconfig(0);
            $modules = $tsConfig['moduleShortcutLinks.'] ?: [];

            foreach ($modules as $key => $module) {
                $moduleName = trim($key, '.');
                \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                    'Libeo.LboBackendShortcuts',
                    'shortcuts',
                    'list_' . $moduleName,
                    '',
                    [
                        'List' => $moduleName,
                    ],
                    [
                        'access' => 'user,group',
                        'icon' => $module['icon'],
                        'labels' => $module['labels'],
                    ]
                );
            }
        }

    }
);
