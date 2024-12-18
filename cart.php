<?php
ob_start();

// include header.php file
include ('header.php');
?>

<?php

    /*  include cart items if it is not empty */
        count($product->getData('cart')) ? include ('Template/cart-template.php') :  include ('Template/notFound/cart_notFound.php');
    /*  include cart items if it is not empty */

        /*  include top sale section */
        count($product->getData('wishlist')) ? include ('Template/wishilist_template.php') :  include ('Template/notFound/wishlist_notFound.php');
        /*  include top sale section */


    /*  include top sale section */
        include ('Template/new-phones.php');
    /*  include top sale section */

?>

<?php
// include footer.php file
include ('footer.php');
?>


