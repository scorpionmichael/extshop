<?php
namespace Scorpshop\Scorpshop\Task;

class LocationTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {
    public function execute() {
    	$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
	    $sampleRepository = $objectManager->get('ScorpShop\Scorpshop\Domain\Repository\ShopRepository');

        $querySettings = $objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setStoragePageIds(array($this->pid));

        $sampleRepository->setDefaultQuerySettings($querySettings);

	    $shops = $sampleRepository->findAll();
        
	    foreach ($shops as $shop) 
	    {
	    	$response = $this->getWebPage('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($shop->getAdress()) . '&key=AIzaSyCdaE87W9QLJMeJf4251-uGN8jH5IGjlSU');
            $content = json_decode($response['content']);

            $shop->setLat($content->results[0]->geometry->location->lat);
            $shop->setLng($content->results[0]->geometry->location->lng);

            $sampleRepository->update($shop);
	    }

	    $objectManager->get('TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface')->persistAll();		

        return true;
    }

    /**
     * @param $url
     */
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