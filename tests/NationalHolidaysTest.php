<?php

use Holidays\Collections\NationalHolidays;

class NationalHolidaysTest extends \PHPUnit_Framework_TestCase
{
    private $collection;

    public function setUp() {
        $this->collection = new NationalHolidays;
    }

    public function testCountCollection()
    {
        $this->assertCount(
            11,
            $this->collection->getCollection()
        );
    }

    public function testAssertEqualsCollectionOrderByNameAscending()
    {
        $this->assertEquals(
            $this->expectedCollectionOrderByNameAscending(),
            $this->collection
                ->orderByName()
                ->ascending()
                ->getCollection()
        );
    }

    public function testAssertInstanceOfFirstElementCollectionOrderByNameAscending()
    {
        $this->assertInstanceOf(
            \Holidays\Types\NewYearsDay::class,
            $this->collection
                ->orderByName()
                ->ascending()
                ->first()
        );
    }

    public function testAssertInstanceOfLastElementCollectionOrderByNameAscending()
    {
        $this->assertInstanceOf(
            \Holidays\Types\TiradentesDay::class,
            $this->collection
                ->orderByName()
                ->ascending()
                ->last()
        );
    }

    public function testAssertEqualsCollectionOrderByNameDescending()
    {
        $this->assertEquals(
            $this->expectedCollectionOrderByNameDescending(),
            $this->collection
                ->orderByName()
                ->descending()
                ->getCollection()
        );
    }

    public function testAssertInstanceOfFirstElementCollectionOrderByNameDescending()
    {
        $this->assertInstanceOf(
            \Holidays\Types\TiradentesDay::class,
            $this->collection
                ->orderByName()
                ->descending()
                ->first());
    }

    public function testAssertInstanceOfLastElementCollectionOrderByNameDescending()
    {
        $this->assertInstanceOf(
            \Holidays\Types\NewYearsDay::class,
            $this->collection
                ->orderByName()
                ->descending()
                ->last()
        );
    }

    public function testAssertEqualsCollectionOrderByDateAscending()
    {
        $this->assertEquals(
            $this->expectedCollectionOrderByDateAscending(),
            $this->collection
                ->orderByDate()
                ->ascending()
                ->getCollection()
        );
    }

    public function testAssertInstanceOfFirstElementCollectionOrderByDateAscending()
    {
        $this->assertInstanceOf(
            \Holidays\Types\NewYearsDay::class,
            $this->collection
                ->orderByDate()
                ->ascending()
                ->first()
        );
    }

    public function testAssertInstanceOfLastElementCollectionOrderByDateAscending()
    {
        $this->assertInstanceOf(
            \Holidays\Types\ChristmasDay::class,
            $this->collection
                ->orderByDate()
                ->ascending()
                ->last()
        );
    }

    public function testAssertEqualsCollectionOrderByDateDescending()
    {
        $this->assertEquals(
            $this->expectedCollectionOrderByDateDescending(),
            $this->collection
                ->orderByDate()
                ->descending()
                ->getCollection()
        );
    }

    public function testAssertInstanceOfFirstElementCollectionOrderByDateDescending()
    {
        $this->assertInstanceOf(
            \Holidays\Types\ChristmasDay::class,
            $this->collection
                ->orderByDate()
                ->descending()
                ->first()
        );
    }

    public function testAssertInstanceOfLastElementCollectionOrderByDateDescending()
    {
        $this->assertInstanceOf(
            \Holidays\Types\NewYearsDay::class,
            $this->collection
                ->orderByDate()
                ->descending()
                ->last()
        );
    }

    private function expectedCollectionDefault()
    {
        return [
            new \Holidays\Types\AllSoulsDay,
            new \Holidays\Types\ChildrenDay,
            new \Holidays\Types\ChristmasDay,
            new \Holidays\Types\EasterSunday,
            new \Holidays\Types\GoodFriday,
            new \Holidays\Types\IndependenceBrazil,
            new \Holidays\Types\LaborDay,
            new \Holidays\Types\NewYearsDay,
            new \Holidays\Types\OurLadyOfAparecida,
            new \Holidays\Types\RepublicProclamationDay,
            new \Holidays\Types\TiradentesDay,
        ];
    }

    private function expectedCollectionOrderByNameAscending()
    {
        $collection = $this->expectedCollectionDefault();

        usort($collection, function(\Holidays\Contract\Holiday $a, \Holidays\Contract\Holiday $b) {
            return $a->getName() > $b->getName();
        });

        return $collection;
    }

    private function expectedCollectionOrderByNameDescending()
    {
        return array_reverse($this->expectedCollectionOrderByNameAscending());
    }

    private function expectedCollectionOrderByDateAscending()
    {
        $collection = $this->expectedCollectionDefault();

        usort($collection, function(\Holidays\Contract\Holiday $a, \Holidays\Contract\Holiday $b) {
            return $a->getDate() > $b->getDate();
        });

        return $collection;
    }

    private function expectedCollectionOrderByDateDescending()
    {
        return array_reverse($this->expectedCollectionOrderByDateAscending());
    }

}