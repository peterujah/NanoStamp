# Nano Stamp
Nano Stamp is Php Class to create a custom stamp using the GD Graphics Library. It simplifies the process of generating stamps, such as circular and square designs, accompanied by dynamic text and styling.


## Installation

Installation is available via Composer:
```md
composer require peterujah/nano-stamp
```

## Example Stamp

<img src="https://raw.githubusercontent.com/peterujah/nano-stamp/main/test/stamp_circle.png" alt="image 1" width="250" /><img src="https://raw.githubusercontent.com/peterujah/nano-stamp/main/test/stamp_circle_vertical.png" alt="image 2" width="250" /><img src="https://raw.githubusercontent.com/peterujah/nano-stamp/main/test/stamp_square.png" alt="image 3" width="250" />


## Initialize class

```php
use NanoBlockTech\Stamp\Circle;
use NanoBlockTech\Stamp\Square;
use NanoBlockTech\Stamp\Colors;
use NanoBlockTech\Stamp\Stamp;
```

To draw a square stamp initialize with a square instance 
```php
$shape = new Stamp(new Square(400, 200));
```
To draw a round stamp initialize with a circle instance 
```php 
$shape = new Stamp(new Circle(400, 400));
```
Use your stamp shape container instance 
```php
$stamp = $shape->getContainerInstance();
```
Set your text font path 
```php
$stamp->setFont(__DIR__ . '/font/industry-bold.ttf');
```
Set your background color or use the default transparent background 
```php 
$stamp->setBackgroundColor(Colors::ALPHA_WHITE);
```

Drow your border with RGB color array
```php
$stamp->drawBorder(Colors::VIOLET);
```

### For Square Shape Stamp
Adjust the `right` and `top` to fit your text 

```php
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
]);
```




### For Circle Shape Stamp
Adjust the `left` and `top` to fit your text 

Drow round text 
```php
$stamp->drawRoundText("Round Text Here", 20, Colors::VIOLET, true);
```
Drow a center text
```php
$stamp->drawCenterText("Horizontal Text Here", [
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
]);
```

To draw a vertical center text only available for circle shape stamp
```php
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
```

Now save, download or preview generated stamp 
Flag `D = Download, S = Save, I = Display `
```php
$stamp->create('stamp_image.png', "S");
```
