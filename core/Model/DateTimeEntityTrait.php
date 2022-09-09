<?php

namespace Core\Model;

use DateTime;

trait DateTimeEntityTrait
{

    protected string $created;
    protected ?string $updated;



    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @return string|null
     */
    public function getUpdated(): ?string
    {
        if ($this->updated)
        {
            return $this->updated;
        }
        return null;
    }


}
