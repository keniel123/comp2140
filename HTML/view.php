<?php
    include 'Views/header.php';
if($customer->is_logged_in()){

   if (isset($_GET['ID'])) {
    $_SESSION['ID']=$_GET['ID'];}
if (isset($_GET['submit'])) {
   $_SESSION['pCode']=$_SESSION['ID'];
   $_SESSION['quantity']=$_GET['quantity'];
   $code=$_SESSION['pCode'];
   $o=$db->prepare("SELECT * FROM product WHERE ID='$code'");
   $o->execute();
   $u=$o->fetch();
   $i=$u['Price'];
   $q=$u['Picture'];
   $r=$u['Name'];

   $a=$db->prepare("INSERT INTO cart (user,productID,quantity,price,Picture,Name) VALUES (:user,:productID,:quantity,:price,:Picture,:Name)");
   $a->execute(array(
    ':user'=>$_SESSION['username'],
    ':productID'=>$_SESSION['pCode'],
    ':quantity'=>$_SESSION['quantity'],
    ':price'=>$i,
    ':Picture'=>$q,
    ':Name'=>$r
    ));
  $id = $db->prepare('SELECT memberID FROM members WHERE username= :username AND active="Yes"');
    $id->execute(array('username' => $_SESSION['username']));
    $row = $id->fetch();
    $l=$row['memberID'];


    $catalog->makeOrder($db,$r,$l,$_SESSION['quantity']*$i,$_SESSION['quantity'],0);
 
                                                      
}
}

  ?>



                        
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
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Search Products</h2>
                        <form action="">
                            <div class="frmSearch">
                            <input type="text" placeholder="Search products..."id="search-box">
                            <div id="suggesstion-box"></div>
                            </div>
                            <input type="submit" value="Search" onclick="href="view.php?ID="+x);">
                        </form>
                    </div>
                   
                
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="index.php">Home</a>
                           
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="" alt="">
                                    </div>
                                    
                                    <div class="product-gallery">
                                        <img src="img/product-thumb-1.jpg" alt="">
                                        <img src="img/product-thumb-2.jpg" alt="">
                                        <img src="img/product-thumb-3.jpg" alt="">
                                        <img src="img/product-thumb-4.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name"> </h2>

                                    <div class="product-inner-price">

                                        Price:<ins></ins>
                                        <div class="product">Quantity: <?php $catalog->getAmount($db,$_SESSION['ID']);?></div>
                                    </div>    
                                    
                                    <form action="" class="cart">
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                        </div>
                                         <input type="submit" value="Add to Cart" name="submit" class="button">
                                         <input type="number" name="submit" value=<?php echo  $_SESSION['ID']?> class"button" style="visibility:hidden">
                                    </form>   
                                    
                                    <div class="product-inner-category">
                                        <p>Category: <a href="">Summer</a>. Tags: <a href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a href="">shoes</a>. </p>
                                    </div> 
                                    
                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>  
                                                <p></p>

                                                
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                    <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                      
                                           

                                                  
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="search.css">
    <!-- Main Script -->
    <script src="js/main.js"></script>
    <script src="js/view.js"></script>
    <script src="js/searchpart.js"></script>
    <?php include "views/footer.php";?>
  