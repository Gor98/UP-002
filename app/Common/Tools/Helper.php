<?php

use App\Common\Tools\Setting;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;

/**
 * return array value or null
 *
 * @param array $data
 * @param string $target
 * @return mixed|null
 */
function getVal(array $data, string $target)
{
    return isset($data[$target]) ? $data[$target] : null;
}

/**
 * @param object $object
 * @return string
 */
function getClassName(object $object): string
{
    return substr(strrchr(get_class($object), "\\"), 1);
}

/**
 * @param int $time
 * @param string $format
 * @return string
 */
function toDate($time, $format = Setting::DATE_TIME_FORMAT): string
{
    return format(Carbon::now()->addSeconds($time), $format);
}

/**
 * @param Carbon $date
 * @param string $format
 * @return string
 */
function format(Carbon $date, string $format = Setting::DATE_TIME_FORMAT)
{
    return $date->format($format);
}

/**
 * @param string $date
 * @return Carbon
 */
function toCarbon($date): Carbon
{
    return Carbon::parse($date);
}

/**
 * @param $startDate
 * @param $endDate
 * @return CarbonPeriod
 */
function period($startDate, $endDate): CarbonPeriod
{
    return new CarbonPeriod($startDate, $endDate);
}

/**
 * @param $start
 * @param $end
 * @return int
 */
function diff($start, $end): int
{
    return toCarbon($start)->diffInSeconds($end);
}

/**
 * @param $start
 * @param $end
 * @return int
 */
function diffInDays($start, $end): int
{
    return toCarbon($start)->diffInDays($end);
}

/**
 * @param $start
 * @param Carbon $end
 * @return string
 */
function diffToHuman($start, Carbon $end): string
{
    return $end->subDays(diffInDays($start, $end))->diffForHumans();
}

/**
 * @param $date
 * @return bool
 */
function expires($date): bool
{
    return !toCarbon($date)->isFuture();
}

/**
 * @param $min
 * @return int
 */
function minToSec($min): int
{
    return $min / 60;
}

/**
 * @param $meters
 * @return int
 */
function toKm($meters): int
{
    return $meters / 1000;
}


/**
 * @param string $path
 * @return string
 */
function toImage(string $path): string
{
    return base64_encode(file_get_contents(public_path($path)));
}

/**
 * @param int $length
 * @return string
 */
function makeToken(int $length = 32): string
{
    return Str::random($length);
}
