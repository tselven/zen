<?php

namespace Core\Interfaces;

interface Middleware{
    public function handle();
    public function after();
}