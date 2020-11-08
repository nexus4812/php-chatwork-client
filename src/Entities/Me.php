<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class Me implements EntityInterface
{
    /**
     * @var string
     */
    public $account_id;

    /**
     * @var string
     */
    public $room_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $chatwork_id;

    /**
     * @var string
     */
    public $organization_id;

    /**
     * @var string
     */
    public $organization_name;

    /**
     * @var string
     */
    public $department;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $introduction;

    /**
     * @var string
     */
    public $mail;

    /**
     * @var string
     */
    public $tel_organization;

    /**
     * @var string
     */
    public $tel_extension;

    /**
     * @var string
     */
    public $tel_mobile;

    /**
     * @var string
     */
    public $skype;

    /**
     * @var string
     */
    public $facebook;

    /**
     * @var string
     */
    public $twitter;

    /**
     * @var string
     */
    public $avatar_image_url;

    /**
     * @var string
     */
    public $login_mail;
}
