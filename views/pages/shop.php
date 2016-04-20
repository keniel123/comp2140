
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="single-product-area">
        <div class="container">
            <div class="row">

<?php 
/* Dynamically generate stuff */
if (isset($_SESSION['account'])){
    $account = $_SESSION['account'];
}
$database = new Database('localhost', 'pdo_ret', 'root', '');
$sql = "select * from product;";
$result = $database->query($sql);
foreach($result as $row){
    /* Create Product and generate row */
    $productId = $row[0];
    $name = $row[1];
    $price = $row[3];
    $product = new Product($productId, $name, $price);
    echo '<div class="col-md-3 col-sm-6">
        <a class = "link" href ="">
            <div class="single-shop-product">
                <div class="product-upper">
                    <img src="" alt="">
                </div>
                <h2><a href="?controller=pages&action=singleproduct">'. $product->getName() .'</a></h2>
                <div class="product-carousel-price">
                    <ins>$'. $product->getPrice() .'</ins>
                </div>  

                <div class="product-option-shop">
                <form role="form" class="form" method="post" action="?controller=control&action=addtocart">
                    <input type="text" hidden="true" value="'. $product->getProductId() .'" name="productid">
                    <div style="display: inline;">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control">
                    </div>
                    <div style="display: inline;">
                    <input type="submit" value="Add to cart" class="btn">
                </form>
                    
                    <a class="add_to_cart_button btn" href="?controller=pages&action=singleproduct">View Product</a><br><br>
                    </div>
                    <p></p>
                </div>                       
            </div>
        </a>
    </div>';
    
}
?>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>                        
                    </div>
                </div>
            </div>
        </div>
    </div>


        
    
    <!-- Main Script -->
    <script src="source-files/js/main.js"></script>
    <script src="source-files/js/shop.js"></script>