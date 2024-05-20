<?php
namespace Core\Interfaces;

interface ViewInterface{
    public function __construct();
    public function css(array $styles);
    public function js(array $scripts);
    public function render();
}