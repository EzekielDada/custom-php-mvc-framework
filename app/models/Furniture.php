<?php

use PDO;

class Furniture extends Model
{
    public function create()
    {
        if (isset($_POST['product_length'], $_POST['product_width'], $_POST['product_height'])) {
            $product_length = static::check($_POST['product_length']);
            $product_width = static::check($_POST['product_width']);
            $product_height = static::check($_POST['product_height']);

            return ['Length' => $product_length, 'Width' => $product_width, 'Height' => $product_height];
        }
        return null;
    }

    public function display()
    {
    }
}
