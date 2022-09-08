<?php

namespace Core\Model;

use DateTime;

trait DateTimeEntityTrait
{

    protected string $created;
    protected ?string $updated;

    /**
     * @return DateTime
     */
    public function getCreated($format = 'd.m.Y'): DateTime
    {
        return DateTime::createFromFormat($format,$this->created);
    }

    /**
     * @return DateTime|null
     */
    public function getUpdated($format = 'd.m.Y'): ?DateTime
    {
        if ($this->updated)
        {
            return DateTime::createFromFormat($format,$this->updated);
        }
        return null;
    }


}
