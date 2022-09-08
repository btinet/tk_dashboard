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
    public function getCreated(): DateTime
    {
        return DateTime::createFromFormat('d.m.Y',$this->created);
    }

    /**
     * @return DateTime|null
     */
    public function getUpdated(): ?DateTime
    {
        if ($this->updated)
        {
            return DateTime::createFromFormat('d.m.Y',$this->updated);
        }
        return null;
    }


}
