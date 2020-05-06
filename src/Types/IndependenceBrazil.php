<?php

namespace Holidays\Types;

/**
 * Class IndependenceBrazil
 * @package Holidays\Types
 */
class IndependenceBrazil extends AbstractHoliday
{
    /**
     * @return mixed|string
     */
    protected function name()
    {
        return "Independência do Brasil";
    }

    /**
     * @return false|mixed|string
     */
    protected function date()
    {
        return date($this->formatter(), $this->timestamp());
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
     * @return false|int
     */
    public function timestamp()
    {
        return strtotime("07 September {$this->getYear()}");
    }
}