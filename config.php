<?php

$block = [
    "ip" => ["127.0.0.1"],
    "host" => [],
    "port" => [],
];
$middleware = [
    "auth" => \App\Middleware\Auth::class,
];
$_ENV["MIDDLEWARE"] = $middleware;
$_ENV["BLOCK_LIST"] = $block;