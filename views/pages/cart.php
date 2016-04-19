    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->
    
    
    <div class="single-product-area">
        <div class="container">
            <div class="row">
                <div class="">
                </div>
                
                <div class="">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="?controller=pages&action=checkout">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-subtotal">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $tr = '<tr>';
                                            $trc = '</tr>';
                                            $td = '<td>';
                                            $tdc = '</td>';
                                            $account = $_SESSION['account'];
                                            $items = $account->fetchItems();
                                            if (count($items) > 0){
                                                foreach($items as $product){
                                                    echo $tr;
                                                    echo $td . $tdc;
                                                    echo $td . $tdc;
                                                    echo $td . $product->getName() . $tdc;
                                                    echo $td . $product->getPrice() . $tdc;
                                                    echo $td . $product->getQuantity() . $tdc;
                                                    echo $td . $product->getPrice() * $product->getQuantity() . $tdc;
                                                    echo $td . '<form method="post" action="?controller=control&action=removefromcart">
                                                    <input type="text" hidden="true" name="productid" value="' . $product->getProductId() . '">
                                                    <input type="number" hidden="true" name="quantity" value="' . $product->getQuantity() . '">
                                                    <input type="submit" value="Remove">
                                                    </form>' . $tdc;
                                                    echo $trc;
                                                }
                                            } else {
                                                echo $tr . $td . '<h3>No items</h3>' . $tdc . $trc;
                                            }
                                        ?>
                                    </tbody>
                                        <tr>
                                            <td class="actions" colspan="6">
                                                
                                                <div class="form-group">
                                                <input type="submit" value="Proceed to Checkout" name="proceed" 
                                                       class="checkout-button button alt wc-forward">
                                                    </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                    </div>
                </div>
            </div>
        </div>
</div>