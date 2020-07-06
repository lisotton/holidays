<?php

namespace Holidays\Collections;

use Holidays\Contract\Collection;
use Holidays\Contract\Holiday;
use InvalidArgumentException;

/**
 * Class AbstractCollection
 * @package Holidays\Collections
 */
abstract class AbstractCollection implements Collection
{
    /**
     * @var array
     */
    protected $collection = [];

    protected $sortField;

    private $year;

    /**
     * AbstractCollection constructor.
     * @param $year
     */
    public function __construct($year)
    {
        $this->year = $year;
        $this->makeCollection();
    }

    private function makeCollection()
    {
        $this->addHoliday(new \Holidays\Types\AllSoulsDay($this->year))
            ->addHoliday(new \Holidays\Types\Carnival($this->year))
            ->addHoliday(new \Holidays\Types\ChildrenDay($this->year))
            ->addHoliday(new \Holidays\Types\ChristmasDay($this->year))
            ->addHoliday(new \Holidays\Types\CorpusChrist($this->year))
            ->addHoliday(new \Holidays\Types\DecemberSolstice($this->year))
            ->addHoliday(new \Holidays\Types\EasterSunday($this->year))
            ->addHoliday(new \Holidays\Types\FatherDay($this->year))
            ->addHoliday(new \Holidays\Types\GoodFriday($this->year))
            ->addHoliday(new \Holidays\Types\IndependenceBrazil($this->year))
            ->addHoliday(new \Holidays\Types\JuneSolstice($this->year))
            ->addHoliday(new \Holidays\Types\LaborDay($this->year))
            ->addHoliday(new \Holidays\Types\MarchEquinox($this->year))
            ->addHoliday(new \Holidays\Types\MotherDay($this->year))
            ->addHoliday(new \Holidays\Types\NewYearsDay($this->year))
            ->addHoliday(new \Holidays\Types\OurLadyOfAparecida($this->year))
            ->addHoliday(new \Holidays\Types\RepublicProclamationDay($this->year))
            ->addHoliday(new \Holidays\Types\SeptemberEquinox($this->year))
            ->addHoliday(new \Holidays\Types\TiradentesDay($this->year));
    }

    /**
     * @param Holiday $holiday
     * @return $this|bool
     */
    private function addHoliday(Holiday $holiday)
    {
        array_push($this->collection, $holiday);
        return $this;
    }

    /**
     * @param \DateTimeInterface $startDate
     * @param \DateTimeInterface $endDate
     * @return $this
     */
    public function between(\DateTimeInterface $startDate, \DateTimeInterface $endDate)
    {
        if ($startDate > $endDate) {
            throw new InvalidArgumentException('Start date must be a date before the end date.');
        }

        $this->collection = array_values(
            array_filter($this->collection, function (Holiday $holiday) use ($startDate, $endDate) {
                return $holiday->formatter('Y-m-d') >= $startDate->format('Y-m-d') &&
                    $holiday->formatter('Y-m-d') <= $endDate->format('Y-m-d');
            })
        );

        return $this;
    }

    /**
     * @param \DateTimeInterface $startDate
     * @param \DateTimeInterface $endDate
     * @return $this
     */
    public function notBetween(\DateTimeInterface $startDate, \DateTimeInterface $endDate)
    {
        if ($startDate > $endDate) {
            throw new InvalidArgumentException('Start date must be a date before the end date.');
        }

        $this->collection = array_values(
            array_filter($this->collection, function (Holiday $holiday) use ($startDate, $endDate) {
                return $holiday->formatter('Y-m-d') < $startDate->format('Y-m-d') ||
                    $holiday->formatter('Y-m-d') > $endDate->format('Y-m-d');
            })
        );

        return $this;
    }

    //maior que
    public function greaterThan(\DateTimeInterface $date)
    {
        $this->collection = array_values(
            array_filter($this->collection, function (Holiday $holiday) use ($date) {
                return $holiday->formatter('Y-m-d') > $date->format('Y-m-d');
            })
        );

        return $this;
    }

    //menor que
    public function lessThan(\DateTimeInterface $date)
    {
        $this->collection = array_values(
            array_filter($this->collection, function (Holiday $holiday) use ($date) {
                return $holiday->formatter('Y-m-d') < $date->format('Y-m-d');
            })
        );

        return $this;
    }

    //maior ou igual que
    public function greaterThanEqual(\DateTimeInterface $date)
    {
        $this->collection = array_values(
            array_filter($this->collection, function (Holiday $holiday) use ($date) {
                return $holiday->formatter('Y-m-d') >= $date->format('Y-m-d');
            })
        );

        return $this;
    }

    //menor ou igual que
    public function lessThanEqual(\DateTimeInterface $date)
    {
        $this->collection = array_values(
            array_filter($this->collection, function (Holiday $holiday) use ($date) {
                return $holiday->formatter('Y-m-d') <= $date->format('Y-m-d');
            })
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function orderByName()
    {
        $this->sortField = 'getName';
        return $this;
    }

    /**
     * @return $this
     */
    public function orderByTimestamp()
    {
        $this->sortField = 'getTimestamp';
        return $this;
    }

    /**
     * @return $this
     */
    public function ascending()
    {
        usort($this->collection, function(Holiday $a, Holiday $b) {
            return $a->{$this->sortField}() > $b->{$this->sortField}();
        });

        return $this;
    }

    /**
     * @return $this
     */
    public function descending()
    {
        usort($this->collection, function(Holiday $a, Holiday $b) {
            return $a->{$this->sortField}() < $b->{$this->sortField}();
        });

        return $this;
    }

    /**
     * @return array
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return current($this->collection);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->collection);
    }

    /**
     * @return int
     */
    public function length()
    {
        return count($this->collection);
    }
}