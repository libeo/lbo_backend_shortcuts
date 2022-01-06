.. include:: ../Includes.txt

.. _configuration:

=============
Configuration
=============

To add a new module
===============

# Usage

1. Add tsconfig in ext_localconf.php
.. code-block:: php
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
        <INCLUDE_TYPOSCRIPT: source="FILE:EXT:site_modele/Configuration/PageTs/ShortcutLinks.tsconfig">
    ');

2. Example of tsconfig
.. code-block:: typoscript
moduleShortcutLinks {
    news {
        urlParameters {
            id = 5
            table = tx_news_domain_model_news
        }
        moduleTarget = web_list
        icon = EXT:site_modele/Resources/Public/Icons/shortcut_news/icon.svg
        labels = LLL:EXT:site_modele/Resources/Private/Language/shortcut_news/locallang_mod.xlf
    }
}


Files locallang_mod.xlf and icon.svg are standard files of modules
