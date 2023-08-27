<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once __DIR__ . "/autoload.php";


use NanoBlockTech\Stamp\Circle;
use NanoBlockTech\Stamp\Square;
use NanoBlockTech\Stamp\Colors;
use NanoBlockTech\Stamp\Stamp;

//$square = new Stamp(new Square(400, 200));
$circle = new Stamp(new Circle(400, 400));
$stamp = $circle->getContainerInstance();

$stamp->setFont(__DIR__ . '/font/industry-bold.ttf');
$stamp->setBackgroundColor(Colors::ALPHA_WHITE);
$stamp->drawBorder(Colors::VIOLET);
/*
$stamp->drawCenterText("My Company Name Here",[
    "fontSize" => 20,
    "color" => Colors::VIOLET,
    "right" => 125,
    "top" => -30,
]); 
$stamp->drawCenterText("27 Aug 2023", [
    "fontSize" => 20,
    "color" => Colors::VIOLET,
    "right" => 80,
    "top" => 30,
]);
$stamp->drawCenterText("Verified Stamp", [
    "fontSize" => 20,
    "color" => Colors::VIOLET,
    "right" => 80,
    "top" => 90,
]);

$stamp->drawRightText("Vertical", [
    "fontSize" => 20,
    "color" => Colors::VIOLET,
    "top" => 110,
    "right" => 55,
]);

$stamp->drawLeftText("27 Aug 2023", [
    "fontSize" => 20,
    "color" => Colors::VIOLET,
    "top" => 170,
    "left" => 230,
]);*/



/* Circle */

$stamp->drawRoundText("Round Text Here", 20, Colors::VIOLET, true);
/*$stamp->drawCenterText("Horizontal Text Here", [
    "fontSize" => 20,
    "color" => Colors::VIOLET,
    "top" => 200,
    "left" => 60,
]);
$stamp->drawCenterText("27 Aug 2023", [
    "fontSize" => 20,
    "color" => Colors::VIOLET,
    "top" => 250,
    "left" => 60,
]);*/


$stamp->drawVerticalText("Vertical Text Here", [
    "fontSize" => 20,
    "color" => Colors::VIOLET,
    "top" => 220,
    "left" => 10,
]);
$stamp->drawVerticalText("27 Aug 2023", [
    "fontSize" => 20,
    "color" => Colors::VIOLET,
    "top" => 170,
    "left" => 15,
]);
$stamp->create('stamp_image.png', "S");
