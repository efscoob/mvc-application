<?php

namespace Application;


interface ILogger
{
    public function error(string $msg, $file, $line);
    public function info(string $msg);
}