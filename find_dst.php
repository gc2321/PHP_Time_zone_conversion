<?php

$tz = new DateTimeZone('America/New_York');

$year = 2019;

$timestamp_start = mktime(0,0,0,1,1,$year);
$timestamp_end = mktime(0,0,0,12,31,$year);

$transitions = $tz->getTransitions($timestamp_start, $timestamp_end);

$dst_starts = new DateTime("@".($transitions[1]['ts']-1));
$dst_starts->setTimezone($tz);

$dst_ends = new DateTime("@".($transitions[2]['ts']-1));
$dst_ends->setTimezone($tz);

$format_string = 'l, F j, Y H:i:s';

echo "DST starts: ".$dst_starts->format($format_string)."<br />";
echo "DST ends: ".$dst_ends->format($format_string)."<br />";

?>