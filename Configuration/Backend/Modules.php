<?php

$tsConfig = \TYPO3\CMS\Backend\Utility\BackendUtility::getPagesTSconfig(0);
$modulesTS = $tsConfig['moduleShortcutLinks.'] ?: [];
$modulesConfig = [];

foreach ($modulesTS as $key => $module) {
    $moduleName = trim($key, '.');

    $modulesConfig['list_' . $moduleName] =  [
        'parent' => 'shortcuts',
        'position' => '',
        'access' => 'user,group',
        'icon' => $module['icon'],
        'labels' => $module['labels'],
        'extensionName' => 'LboBackendShortcuts',
        'path' => "/module/shortcuts/{$moduleName}",
        'controllerActions' => [
            \Libeo\LboBackendShortcuts\Controller\ListController::class => [$moduleName],
        ],
    ];
}


if (count($modulesConfig)) {
    return [
        'shortcuts' => [
            'name' => 'shortcuts',
            'position' => ['after' => 'web'],
            'iconIdentifier' => 'actions-wizard-link',
            'labels' => 'LLL:EXT:lbo_backend_shortcuts/Resources/Private/Language/locallang_mod.xlf',
        ],
        ...$modulesConfig
    ];
}

