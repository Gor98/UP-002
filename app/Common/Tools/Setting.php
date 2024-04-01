<?php

namespace App\Common\Tools;

/**
 * Class Setting
 * @package App\Common\Tools
 */
class Setting
{
    public const PAGE_SIZE = 5;
    public const COLUMNS = '*';
    public const DESC = 'DESC';
    public const ASC = 'ASC';
    public const DEFAULT_ORDER = 'created_at';
    public const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
    public const DATE_FORMAT = 'Y-m-d';
    public const TIME_FORMAT = 'H:i:s';

    public const ORDERS = [
        self::DESC,
        self::ASC,
    ];
}
