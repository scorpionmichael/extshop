<?php
namespace ScorpShop\Scorpshop\Controller;

/***
 *
 * This file is part of the "ScorpShop" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017
 *
 ***/

/**
 * ShopController
 */
class ShopController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * shopRepository
     *
     * @var \ScorpShop\Scorpshop\Domain\Repository\ShopRepository
     * @inject
     */
    protected $shopRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $points = [];
        $shops = [];

        if ($GLOBALS['TSFE']->fe_user->groupData)
        {
            foreach ($GLOBALS['TSFE']->fe_user->groupData['uid'] as $groupId) 
            {
                $shopsGroup = $this->shopRepository->findByGroupId($groupId);

                foreach ($shopsGroup as $shop) 
                {
                    array_push($shops, $shop);
                }
            }
        }

        foreach ($shops as $shop) 
        {
            array_push($points, ['lat' => floatval($shop->getLat()), 'lng' => floatval($shop->getLng())]);
        }

        //\TYPO3\CMS\Core\Utility\DebugUtility::debug($points);
        $this->view->assign('shops', $shops);
        $this->view->assign('points', json_encode($points));
    }

    /**
     * action show
     *
     * @param \ScorpShop\Scorpshop\Domain\Model\Shop $shop
     * @return void
     */
    public function showAction(\ScorpShop\Scorpshop\Domain\Model\Shop $shop)
    {
        $this->view->assign('shop', $shop);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
     *
     * @param \ScorpShop\Scorpshop\Domain\Model\Shop $newShop
     * @return void
     */
    public function createAction(\ScorpShop\Scorpshop\Domain\Model\Shop $newShop)
    {
        $this->shopRepository->add($newShop);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \ScorpShop\Scorpshop\Domain\Model\Shop $shop
     * @ignorevalidation $shop
     * @return void
     */
    public function editAction(\ScorpShop\Scorpshop\Domain\Model\Shop $shop)
    {
        $this->view->assign('shop', $shop);
    }

    /**
     * action update
     *
     * @param \ScorpShop\Scorpshop\Domain\Model\Shop $shop
     * @return void
     */
    public function updateAction(\ScorpShop\Scorpshop\Domain\Model\Shop $shop)
    {
        $this->shopRepository->update($shop);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \ScorpShop\Scorpshop\Domain\Model\Shop $shop
     * @return void
     */
    public function deleteAction(\ScorpShop\Scorpshop\Domain\Model\Shop $shop)
    {
        $this->shopRepository->remove($shop);
        $this->redirect('list');
    }
}
