<?php

namespace Shared\Util;

use Constants\AppConstants;

final class DateTimeUtil
{
    private function __construct()
    {
    }

    public static function currentDateTime(){
        return new \DateTime('now', new \DateTimeZone('UTC'));
    }

    /**
     * @param \DateTime $dateTime
     * @param int $minutes
     * @return bool
     */
    public static function currentDateTimeMoreThan(\DateTime $dateTime, int $minutes){

        if($dateTime == null) {
            return true;
        }

        //Convert DateTime to Immutable
        $immutableDateTime = \DateTimeImmutable::createFromMutable($dateTime);

        /**
         * Convert "$minutes" to DateInterval
         *
         * @var \DateInterval $dateInterval
         */
        $dateInterval = new \DateInterval('PT'.$minutes.'M');

        $dateTimeAfterAddingMinutes = $immutableDateTime->add($dateInterval);

        return self::currentDateTime() > $dateTimeAfterAddingMinutes;
    }

    public static function addNumberOfDaysToCurrentDateBy(int $days){

        if($days == null) {
            return null;
        }

        /**
         * Example: Two days is P2D.
         */
        $dateInterval = new \DateInterval('P'.$days.'D');
        return self::currentDateTime()->add($dateInterval);
    }

    public static function addNumberOfDays(\DateTime $dateTime, int $days){

        if($days == null || $dateTime == null) {
            return null;
        }

        //Convert Date Time to Immutable
        $immutableDateTime = \DateTimeImmutable::createFromMutable($dateTime);

        /**
         * Example: Two days is P2D.
         */
        $dateInterval = new \DateInterval('P'.$days.'D');

        return $immutableDateTime->add($dateInterval);
    }

    public static function currentDateTimeAsString(){
        return self::currentDateTime()->format(AppConstants::DATE_TIME_FORMAT);
    }

    public static function convertDateToString(\DateTime $dateTime){
        return $dateTime->format(AppConstants::DATE_FORMAT);
    }

    public static function stringDateValueAsObject(string $date){
        if($date == null) {
            return null;
        }
        return \DateTime::createFromFormat(AppConstants::DATE_FORMAT, $date);
    }

    public static function stringDateTimeValueAsObject(string $date){
        if($date == null) {
            return null;
        }
        return \DateTime::createFromFormat(AppConstants::DATE_TIME_FORMAT, $date);
    }
}
