<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

call_user_func(function ($packageKey) {
    $extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToLowerCamelCase($packageKey);
    $pluginSignature = strtolower($extensionName).'_pi1';

    $tempColumns = [
        'tx_mailfiles_pluploadfe_config' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:pluploadfe/Resources/Private/Language/locallang_db.xml:tt_content.tx_pluploadfe_config',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_pluploadfe_config',
                'foreign_table' => 'tx_pluploadfe_config',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                    ],
                ],
            ],
        ],
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'tx_mailfiles_pluploadfe_config';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';

    // Add plugin
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Mailfiles',
        'Pi1',
        'LLL:EXT:mailfiles/Resources/Private/Language/locallang_db.xlf:plugin.title'
    );
}, 'mailfiles');
