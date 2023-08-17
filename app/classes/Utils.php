<?php

class Utils
{

    function format_date($date)
    {
        $timestamp = strtotime($date);
        return date('d.m.Y', $timestamp);
    }

}