<?php


namespace App\Common\Constants;

/**
 * Class RepositorySettings
 * @package App\Constants
 */
class RepositorySettings
{
    public const PAGE_SIZE = 10;
    public const COLUMNS = '*';
    public const DESC = 'DESC';
    public const ASC = 'ASC';
    public const DEFAULT_ORDER = 'created_at';
    public const DATE_TIME_FORMAT= 'Y-m-d h:i:s';

    public const ORDERS = [
        self::DESC,
        self::ASC,
    ];
}
