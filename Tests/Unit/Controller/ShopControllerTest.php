<?php
namespace ScorpShop\Scorpshop\Tests\Unit\Controller;

/**
 * Test case.
 */
class ShopControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ScorpShop\Scorpshop\Controller\ShopController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ScorpShop\Scorpshop\Controller\ShopController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllShopsFromRepositoryAndAssignsThemToView()
    {

        $allShops = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $shopRepository = $this->getMockBuilder(\ScorpShop\Scorpshop\Domain\Repository\ShopRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $shopRepository->expects(self::once())->method('findAll')->will(self::returnValue($allShops));
        $this->inject($this->subject, 'shopRepository', $shopRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('shops', $allShops);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenShopToView()
    {
        $shop = new \ScorpShop\Scorpshop\Domain\Model\Shop();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('shop', $shop);

        $this->subject->showAction($shop);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenShopToShopRepository()
    {
        $shop = new \ScorpShop\Scorpshop\Domain\Model\Shop();

        $shopRepository = $this->getMockBuilder(\ScorpShop\Scorpshop\Domain\Repository\ShopRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $shopRepository->expects(self::once())->method('add')->with($shop);
        $this->inject($this->subject, 'shopRepository', $shopRepository);

        $this->subject->createAction($shop);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenShopToView()
    {
        $shop = new \ScorpShop\Scorpshop\Domain\Model\Shop();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('shop', $shop);

        $this->subject->editAction($shop);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenShopInShopRepository()
    {
        $shop = new \ScorpShop\Scorpshop\Domain\Model\Shop();

        $shopRepository = $this->getMockBuilder(\ScorpShop\Scorpshop\Domain\Repository\ShopRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $shopRepository->expects(self::once())->method('update')->with($shop);
        $this->inject($this->subject, 'shopRepository', $shopRepository);

        $this->subject->updateAction($shop);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenShopFromShopRepository()
    {
        $shop = new \ScorpShop\Scorpshop\Domain\Model\Shop();

        $shopRepository = $this->getMockBuilder(\ScorpShop\Scorpshop\Domain\Repository\ShopRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $shopRepository->expects(self::once())->method('remove')->with($shop);
        $this->inject($this->subject, 'shopRepository', $shopRepository);

        $this->subject->deleteAction($shop);
    }
}
