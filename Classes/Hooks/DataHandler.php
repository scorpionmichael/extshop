<?php

namespace ScorpShop\Scorpshop\Hooks;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use GeorgRinger\News\Service\AccessControlService;
use TYPO3\CMS\Backend\Utility\BackendUtility as BackendUtilityCore;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Hook into tcemain which is used to show preview of news item
 *
 */
class DataHandler
{
	/**
    * Prevent saving of a news record if the editor doesn't have access to all categories of the news record
     *
     * @param array $fieldArray
     * @param string $table
     * @param int $id
     * @param $parentObject \TYPO3\CMS\Core\DataHandling\DataHandler
     */

    public function processDatamap_preProcessFieldArray(&$fieldArray, $table, $id, $parentObject)
    {
        //\TYPO3\CMS\Core\Utility\DebugUtility::debug($fieldArray);

        $response = $this->getWebPage('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($fieldArray['adress']) . '&key=AIzaSyCdaE87W9QLJMeJf4251-uGN8jH5IGjlSU');
        $content = json_decode($response['content']);

        $fieldArray['lat'] = $content->results[0]->geometry->location->lat;
        $fieldArray['lng'] = $content->results[0]->geometry->location->lng;
    }

    private function getWebPage($url)
    {
        $uagent = 'Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.14';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // возвращает веб-страницу
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // не возвращает заголовки
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // переходит по редиректам
        curl_setopt($ch, CURLOPT_ENCODING, '');
        // обрабатывает все кодировки
        curl_setopt($ch, CURLOPT_USERAGENT, $uagent);
        // useragent
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        // таймаут соединения
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        // таймаут ответа
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        // останавливаться после 10-ого редиректа
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);
        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $header;
    }
}