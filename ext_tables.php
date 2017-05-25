<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ScorpShop.Scorpshop',
            'Shop',
            'Shop'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'ScorpShop');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_scorpshop_domain_model_shop', 'EXT:scorpshop/Resources/Private/Language/locallang_csh_tx_scorpshop_domain_model_shop.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_scorpshop_domain_model_shop');

    },
    $_EXTKEY
);
