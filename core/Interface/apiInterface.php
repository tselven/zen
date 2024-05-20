<?php
namespace Core\Interfaces;

interface ApiInterface{
    public function GET();
    public function POST();
    public function PUT();
    public function DELETE();
}