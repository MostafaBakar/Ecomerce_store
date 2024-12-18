<?php
    ob_start();
    // include header.php file
    include ('header.php');
?>

<?php

    /*  include banner area  */
        include ('Template/banner-area.php');
    /*  include banner area  */

    /*  include top sale section */
        include ('Template/top-sale.php');
    /*  include top sale section */

    /*  include special price section  */
         include ('Template/special-price.php');
    /*  include special price section  */

    /*  include banner ads  */
        include ('Template/banner-ads.php');
    /*  include banner ads  */

    /*  include new phones section  */
        include ('Template/new-phones.php');
    /*  include new phones section  */

    /*  include blog area  */
         include ('Template/blogs.php');
    /*  include blog area  */

?>


<?php
// include footer.php file
include ('footer.php');
?>