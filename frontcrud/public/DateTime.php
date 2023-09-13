<?php
class DateTime implements DateTimeInterface {
/* Constantaes heredadas constants */
const string DateTimeInterface::ATOM = "Y-m-d\TH:i:sP";
const string DateTimeInterface::COOKIE = "l, d-M-Y H:i:s T";
const string DateTimeInterface::ISO8601 = "Y-m-d\TH:i:sO";
const string DateTimeInterface::RFC822 = "D, d M y H:i:s O";
const string DateTimeInterface::RFC850 = "l, d-M-y H:i:s T";
const string DateTimeInterface::RFC1036 = "D, d M y H:i:s O";
const string DateTimeInterface::RFC1123 = "D, d M Y H:i:s O";
const string DateTimeInterface::RFC2822 = "D, d M Y H:i:s O";
const string DateTimeInterface::RFC3339 = "Y-m-d\TH:i:sP";
const string DateTimeInterface::RFC3339_EXTENDED = "Y-m-d\TH:i:s.vP";
const string DateTimeInterface::RSS = "D, d M Y H:i:s O";
const string DateTimeInterface::W3C = "Y-m-d\TH:i:sP";
/* Métodos */
public __construct(string $time = "now", DateTimeZone $timezone = null)
public add(DateInterval $interval): DateTime
public static createFromFormat(string $format, string $time, DateTimeZone $timezone = ?): DateTime
public static createFromImmutable(DateTimeImmutable $object): DateTime
public static createFromInterface(DateTimeInterface $object): DateTime
public static getLastErrors(): array
public modify(string $modify): DateTime
public static __set_state(array $array): DateTime
public setDate(int $year, int $month, int $day): DateTime
public setISODate(int $year, int $week, int $day = 1): DateTime
public setTime(int $hour, int $minute, int $second = 0): DateTime
public setTimestamp(int $unixtimestamp): DateTime
public setTimezone(DateTimeZone $timezone): DateTime
public sub(DateInterval $interval): DateTime
public diff(DateTimeInterface $datetime2, bool $absolute = false): DateInterval
public format(string $format): string
public getOffset(): int
public getTimestamp(): int
public getTimezone(): DateTimeZone
public __wakeup()
}
?>