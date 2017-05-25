<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'ScorpShop.Scorpshop',
            'Shop',
            [
                'Shop' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'Shop' => 'create, update, delete'
            ]
        );

		// wizards
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
			'mod {
				wizards.newContentElement.wizardItems.plugins {
					elements {
						shop {
							icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_shop.svg
							title = LLL:EXT:scorpshop/Resources/Private/Language/locallang_db.xlf:tx_scorpshop_domain_model_shop
							description = LLL:EXT:scorpshop/Resources/Private/Language/locallang_db.xlf:tx_scorpshop_domain_model_shop.description
							tt_content_defValues {
								CType = list
								list_type = scorpshop_shop
							}
						}
					}
					show = *
				}
		   }'
		);

		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$extKey] = \ScorpShop\Scorpshop\Hooks\DataHandler::class;

		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Scorpshop\Scorpshop\Task\LocationTask::class] = array(
	        'extension' => $extKey,
	        'title' => 'LocationTask',
	        'description' => 'LLL:EXT:' . $extKey . '/locallang.xlf:cachingFrameworkGarbageCollection.description',
	        'additionalFields' => \Scorpshop\Scorpshop\Task\LocationTaskAdditionalFieldProvider::class
		);
    },
    $_EXTKEY
);
