<?php
namespace ScorpShop\Scorpshop\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class ShopTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ScorpShop\Scorpshop\Domain\Model\Shop
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ScorpShop\Scorpshop\Domain\Model\Shop();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );

    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getAdressReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAdress()
        );

    }

    /**
     * @test
     */
    public function setAdressForStringSetsAdress()
    {
        $this->subject->setAdress('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'adress',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getPhoneReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPhone()
        );

    }

    /**
     * @test
     */
    public function setPhoneForStringSetsPhone()
    {
        $this->subject->setPhone('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'phone',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getUrlReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getUrl()
        );

    }

    /**
     * @test
     */
    public function setUrlForStringSetsUrl()
    {
        $this->subject->setUrl('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'url',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getLatReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLat()
        );

    }

    /**
     * @test
     */
    public function setLatForStringSetsLat()
    {
        $this->subject->setLat('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'lat',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getLngReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLng()
        );

    }

    /**
     * @test
     */
    public function setLngForStringSetsLng()
    {
        $this->subject->setLng('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'lng',
            $this->subject
        );

    }
}
