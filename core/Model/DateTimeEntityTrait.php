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
        return $this->updated ? $this->updated : null;
    }


}
