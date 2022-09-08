<?php

namespace Core\Model;


trait IdEntityTrait
{

    protected int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}
