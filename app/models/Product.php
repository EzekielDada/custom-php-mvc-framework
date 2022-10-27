<?php
require_once './app/core/Model.php';
require_once './app/core/App.php';
class Product extends Model
{
    public static function createProduct()
    {
        if (isset($_POST['product_sku'], $_POST['product_name'], $_POST['product_price'])) {
            $product_sku = static::check($_POST['product_sku']);
            $product_name = static::check($_POST['product_name']);
            $product_price = static::check($_POST['product_price']);
            $product_type = static::check($_POST['product_type']);
            $product_size = static::check($_POST['product_size']);
            $product_weight = static::check($_POST['product_weight']);
            $product_length = static::check($_POST['product_length']);
            $product_width = static::check($_POST['product_width']);
            $product_height = static::check($_POST['product_height']);

            if (static::insertProduct($product_sku, $product_type, $product_name, $product_price, $product_size, $product_weight, $product_length, $product_width, $product_height)) echo "success";
        }
    }

    //private function to insert product details into the database
    private  static function insertProduct($sku, $type, $name, $price)
    {
        try {
            $db = static::getDB();

            $data = ['`SKU`' => "'$sku'", '`Name`' => "'$name'", '`product_type`' => "'$type'", '`Price`' => "'$price'"];

            $Book = new Book;
            $product = $Book->create();
            if (is_null($product)) $data = array_merge($data, $product);

            $Disc = new Disc;
            $product = $Disc->create();
            if (is_null($product)) $data = array_merge($data, $product);

            $Furniture = new Furniture;
            $product = $Furniture->create();
            if (is_null($product)) $data = array_merge($data, $product);

            $fields = implode(',', array_keys($data));
            $values = implode(',', array_values($data));

            $sql = $db->query("INSERT INTO ($fields) VALUES($values)");

            return $sql ? true : false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getAll()
    {

        try {
            $db = static::getDB();
            $statement = $db->query("SELECT * FROM `products`");
            return $statement;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function deleteProducts()
    {
        $db = static::getDB();
        if (isset($_POST['delete-id'])) {
            $selected_id = $_POST['delete-id']; // an array of ids
            $extract_id = implode(',', $selected_id);
            $result =  $db->query("DELETE FROM products WHERE id IN ($extract_id)");
            if ($result) {
                echo 'success';
                return true;
            }
        }

        return false;
    }
}
