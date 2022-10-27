<?php

use PDO;

class Book extends Model
{
    public function create()
    {
        if (isset($_POST['product_size'])) {
            $size = static::check($_POST['product_size']);

            return ['Size' => $size];
        }
        return null;
    }
}
