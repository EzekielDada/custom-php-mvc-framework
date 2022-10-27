<?php
require_once 'app/models/Product.php';
class HomeController extends Controller
{

  function __construct()
  {
  }

  public function displayProducts()
  {
    $posts = Product::getAll();
    //$posts = $this->model('Product')->getAll();
    $rows = $posts->rowCount();
    for ($i = 0; $i < $rows; ++$i) {
      $result = $posts->fetch(PDO::FETCH_ASSOC);
      $weight = !!$result['Weight'] ? "<li>Weight: {$result['Weight']}KG</li>" : "";
      $size = !!$result['Size'] ? "<li>Size:{$result['Size']}MB</li>" : "";
      $dimension = !!$result['Length'] ? "<li>Dimension: {$result['Length']}x{$result['Width']}x{$result['Height']}</li>" : "";
      echo "<div class='product' result-product-id='{$result['id']}'>
            <label class='product-inn'>
              <div class='checkbox-wrap'>
                <input type='checkbox' name='product' class='delete-checkbox' value='{$result['id']}'/>
                <i class='fas fa-check check-icon'></i>
              </div>
              <h2 class='title'>{$result['SKU']}</h2>
              <ul class='product-details'>
                <li>{$result['Name']}</li>
                <li>{$result['Price']}$</li>
                $weight $size $dimension
              </ul>
            </label>
          </div>";
    }

    $this->view('home/index', ['posts' => $posts]);
  }



  public function createProduct()
  {
    Product::createProduct();
    //$this->view('home/product_add');
  }
  public function deleteProducts()
  {
    Product::deleteProducts();
  }
}

$Posts = new HomeController;
$Posts->createProduct();
