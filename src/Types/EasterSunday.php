<?php

namespace Holidays\Types;

/**
 * Class EasterSunday
 * @package Holidays\Types
 */
class EasterSunday extends AbstractEaster
{
    /**
     * AllSoulsDay constructor.
     * @param null $year
     */
    public function __construct($year = null)
    {
        parent::__construct($year);
    }

    /**
     * @return mixed|string
     */
    protected function name()
    {
        return "Páscoa";
    }

    /**
     * @return bool|mixed
     */
    protected function national()
    {
        return true;
    }

    /**
     * @return mixed|string
     */
    protected function type()
    {
        return \Holidays\Domain\TypeHoliday::NATIONAL_HOLIDAY;
    }

    /**
     * @param $year
     * @return int
     */
    protected function timestamp($year)
    {
        return $this->getDateEaster($year);
    }
}