<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class Link
{
    /**
     * @var bool
     */
    public $public;

    /**
     * @var string
     */
    public $url;

    /**
     * @var bool
     */
    public $need_acceptance;

    /**
     * @var string
     */
    public $description;
}
