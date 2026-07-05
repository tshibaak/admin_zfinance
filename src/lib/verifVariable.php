<?php
    function verifVar($var ,string $message = '')
    {
        if(!isset($var) && empty($var))
        {
            return " " . $message;
        }
    }