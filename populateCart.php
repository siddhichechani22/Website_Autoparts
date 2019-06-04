<?php
$link = mysqli_connect('localhost', 'root', '', 'onlineautopartsstore');

if (!$link)
{
    die("Not Connecting to Database");
    exit();
}


$getCart = "SELECT * FROM item inner JOIN cart ON item.item_ID=cart.item_ID";

$totalPrice=0;



$_SESSION["query_result"] = $link->query($getCart);



    while ($_SESSION["rows"] = ($_SESSION["query_result"]->fetch_object()))
    {

        $itemID = $_SESSION["rows"]->item_ID;




        if ($user_ID == $_SESSION["rows"]->user_ID)
        {

            ?>


            <tr>
                <td class="cart_product">
					<?php echo '<a href="product-details.html?item_ID='.$_SESSION["rows"]->item_ID.'">'; ?>
                    <img src=<?php ;
                    echo '"images/product-details/' . $_SESSION["rows"]->item_ID . '.jpg"' ?> alt="<?php $_SESSION["rows"]->item_name ?>"/>
					<?php echo '</a>'?>
				</td>
                <td class="cart_description">
                    <h4>
						<?php echo '<a href="product-details.html?item_ID='.$_SESSION["rows"]->item_ID.'">'; ?>
                            <?php $temp = $_SESSION["rows"]->item_name;
                            echo "$temp"; ?>
                        </a></h4>
						<?php echo '<p>Item ID: '.$_SESSION["rows"]->item_ID.'</p>';?>
                </td>
                <td class="cart_price">
                    <h2><?php $price = $_SESSION["rows"]->price;
                        $totalPrice = $totalPrice + $price * $_SESSION["rows"]->quantity;
                        echo "$$price"; ?></h2>
                </td>
                <td class="cart_quantity">
                    <div class="cart_quantity_button">
                        <span><?php echo  $_SESSION["rows"]->quantity ?></span>
                    </div>
                </td>

                <td class="cart_delete">
					<form id="delete_from_cart" name="delete_from_cart" method="POST" action="deleteFromCart.php">
						<button id="delete_from_cart_button" name="delete_from_cart_button" type="submit" class="cart_quantity_delete fa fa-times"></button>
						<input type="hidden" id="cart_item_id" name="cart_item_id" value="<?php echo $_SESSION["rows"]->item_ID; ?>">
						<input type="hidden" id="user_ID" name="user_ID" value="<?php echo $user_ID; ?>">
					</form>
                </td>
            </tr>


            <?php


        }



    } ?>
