<?php
include_once 'DbConnection.php';

class Warehouse
{
    // define the max height, basic width and the max count of the products
    const HEIGHT = 3600;
    const WIDTH = 1000000;
    const MAX_COUNT_PRODUCT = 5;

    // properties for the length and width of the warehouse
    private static $length = 0;
    private static $width = 0;

    // masks for insertProduct (save the last state of height and width)
    private static $lastHeight = 0;
    private static $lastWidth = 0;

    public static function insertProduct($productDimensions)
    {
        $countProduct = 0;
        $needMove = false;

        $currentHeight = self::$lastHeight;
        $currentWidth = self::$lastWidth;

        // get the dimensions of the current product
        $height = floatval($productDimensions['height']);
        $length = floatval($productDimensions['length']);
        $width = floatval($productDimensions['width']);

        // insert 5 items in the warehouse
        while ($countProduct < self::MAX_COUNT_PRODUCT) {

            // check if we can insert item on top and increase the currentHeight
            if ($height + $currentHeight < self::HEIGHT) {
                $currentHeight += $height;
            }

            else {
                if ($width + $currentWidth < self::WIDTH) {
                    // increase the current width
                    $currentWidth += $width;
                }

                else {
                    // set the current width and increase the how length
                    $currentWidth = $width;
                    self::$length += $length;
                }

                $currentHeight = $height;
                $needMove = true; // mask for move the item by width or length
            }

            $countProduct++;
        }

        // insert the new item
        if ($needMove === true) {
            self::$length += $length;
            self::$width += $width;
        }

        // set the masks to the new values
        self::$lastHeight = $currentHeight;
        self::$lastWidth = $currentWidth;
    }

    public static function getLength()
    {
        return self::formatDimension(self::$length);
    }

    public static function getWidth()
    {
        return self::formatDimension(self::$width);

    }

    private static function formatDimension($dimension)
    {
        $meters = $dimension / 1000;
        $formatted =  number_format($meters, 3, ".", " ");

        $meters = intval($formatted);
        $centimeters = intval(($formatted - $meters) * 100);
        $millimeters = $dimension % 10;

        return "Meters: {$meters}; Centimeters: {$centimeters}; Millimeters: {$millimeters}";
    }

    public static function printDimensions()
    {
        echo "Length: " . self::getLength() . "<br />";
        echo "Width: " . self::getWidth() . "<br />";
    }
}
