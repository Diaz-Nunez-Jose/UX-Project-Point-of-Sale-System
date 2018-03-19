<?php
    session_start();
    // session_destroy();
    require "get-db.php";
    $db = getDb();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["delete"]) && isset($_SESSION["item-ids"]) && isset($_SESSION["order" ])) {
            $lastId = array_pop($_SESSION["item-ids"]);
            $currentItemQuantity = $_SESSION["order"][$lastId]["quantity"];

            if ($currentItemQuantity > 1) {
                $_SESSION["order"][$lastId]["quantity"]--;
            } else {
                unset($_SESSION["order"][$lastId]);
            }
        }

        $_SESSION["first-visit"] = false;
        // $_SESSION["category"] = "";

        if (isset($_POST["drinks"])) {
            $_SESSION["category"] = "Drinks";
        } else if (isset($_POST["appetizers"])) {
            $_SESSION["category"] = "Appetizers";
        } else if (isset($_POST["entrees"])) {
            $_SESSION["category"] = "Entrees";
        } else if (isset($_POST["desserts"])) {
            $_SESSION["category"] = "Desserts";
        } else if (isset($_POST["sides"])) {
            $_SESSION["category"] = "Sides";
        } else if (isset($_POST["promos"])) {
            $_SESSION["category"] = "Promos";
        }
        // $category = $_SESSION["category"];
    } else {
        $_SESSION["first-visit"] = true;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>POS System | Order Creation Screen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="order-creation.css" />
    <script src="order-creation.js"></script>
</head>
<body onload="loadButtonStyles();">

<?php 
    if (isset($_GET['item'])) {
        $_SESSION["first-visit"] = false;

        $id = $_GET['id'];
        $item = $_GET['item'];
        $price = $_GET['price'];

        if (!isset($_SESSION["order"])) {
            $_SESSION["order"] = array();
            $_SESSION["item-ids"] = [];
        }            

        array_push($_SESSION["item-ids"], $id); 

        if (!array_key_exists ($id , $_SESSION["order"])) {
            $_SESSION["order"][$id] = array();
            $_SESSION["order"][$id]["item"] = $item;
            $_SESSION["order"][$id]["price"] = $price;
            $_SESSION["order"][$id]["quantity"] = 1;
        } else {
            // $_SESSION["order"][$id]["item"] = $item;
            // $_SESSION["order"][$id]["price"] = $price;
            $_SESSION["order"][$id]["quantity"] += 1;
        }

        echo "<script type='text/javascript'>location.hash = '#' + $id;</script>";
    }
 ?>

    <div class="wrapper">
        <div class="main">
            <div class="order-summary">
                <div class="order-header">
                    <div class="logo-img">
                        <img src="images/logo.PNG" alt="The Daily Catch Logo" height="20" width="20">
                    </div>
                    <div class="logo-text">
                        The Daily Catch
                    </div>
                    <div class="order-summary-text">
                        Order Summary
                    </div>
                </div>
                <div class="order-items">
                    <div style="padding-top: 2%; border-top: 0.5px solid gray;">
                        <span style='float: left; padding-left: 1%'>Qty</span>                         
                        <span style="padding-left: 25%">Item name</span>
                        <span style='float: right; padding-right: 2%'>Price</span>
                        <hr>
                    </div>
                    <?php 
                        foreach ($_SESSION["order"] as $item) {
                            if(strlen($item["item"]) > 3)
                                $itemName = substr($item["item"], 0, 33) . "...";
                            else
                                $itemName = $item["item"];
                            echo "(" . $item["quantity"] . ") " . 
                            $itemName . 
                            "<span style='float:right; font-weight: bold; padding-right: 1%'>$" . round($item["price"] * $item["quantity"], 2) . "</span><br><br>";
                        }
                    ?>
                </div>
                <div class="order-total">
                    Total
                    <?php 
                        $total = 0.00;
                        foreach ($_SESSION["order"] as $item) {
                            $total += ((float) $item["price"] * (float) $item["quantity"]);
                        }
                        if($total == 0)
                            echo "<span style='float: right; padding-right: 2%'>--</span>";
                        else
                            echo "<span style='float: right; padding-right: 2%'>$" . round($total, 2) . "</span>";
                    ?>
                </div>
            </div>

            <div class="menu-items">
                <?php
                    if (!$_SESSION["first-visit"]) {
                        $category = $_SESSION["category"];
                        $stmt = $db->prepare("SELECT *
                                              FROM   product
                                              WHERE  product_category = '$category'");
                        $stmt->execute();
                        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($products as $product) {
                            $id    = $product["product_id"];
                            $name  = $product["product_name"];
                            $price = $product["price"];
                            $url   = $product["product_image_url"];

                            echo "
                                <a id=$id href='order-creation.php?id=$id&item=$name&price=$price'>
                                    <div class='card'>
                                      <div class='card-content'>
                                        <img src='$url' alt='Picture' height='10' weight='10' style='border-radius: 3%'/>
                                        <strong>$name</strong>
                                        <p style='border-bottom: 0.5px solid rgb(161, 161, 161); padding-bottom: 2%'>$$price</p>
                                      </div>
                                    </div>
                                </a>
                            ";
                        }
                    }
                ?>
            </div>

            <div class="menu-categories">
                <div>
                    <form id="drinks" method="post" action="order-creation.php">
                        <input type="hidden" name="drinks">
                        <button id="drinks" type="submit" form="drinks" class="menu-categories-button-drinks"
                        value="Drinks" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                Drinks
                        </button>
                    </form>                    
                </div>
                <div>
                    <form id="appetizers" method="post" action="order-creation.php">
                        <input type="hidden" name="appetizers">
                        <button id="apps" type="submit" form="appetizers" class="menu-categories-button-appetizers"
                        value="Apps" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                Appetizers
                        </button>
                    </form>    
                </div>
                <div>
                    <form id="entrees" method="post" action="order-creation.php">
                        <input type="hidden" name="entrees">
                        <button id="entrees" type="submit" form="entrees" class="menu-categories-button-entrees"
                        value="Entrees" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                Entrees
                        </button>
                    </form>    
                </div>
                <div>
                    <form id="desserts" method="post" action="order-creation.php">
                        <input type="hidden" name="desserts">
                        <button id="desserts" type="submit" form="desserts" class="menu-categories-button-desserts"
                        value="Desserts" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                Desserts
                        </button>
                    </form>    
                </div>
                <div>
                    <form id="sides" method="post" action="order-creation.php">
                        <input type="hidden" name="sides">
                        <button id="sides" type="submit" form="sides" class="menu-categories-button-sides-and-takeout"
                        value="Sides" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                Sides &amp; Takeout
                        </button>
                    </form>    
                </div>
                <div>
                    <form id="promos" method="post" action="order-creation.php">
                        <input type="hidden" name="promos">
                        <button id="promos" type="submit" form="promos" class="menu-categories-button-promos-and-specials"
                        value="Promos" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                Promos &amp; Specials
                        </button>
                    </form>    
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="order-management">
                <div>
                    <button class="order-management-button-send-stay" onclick="alert('SENDING ITEM(S)...');" value="SendStay" 
                    onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                        Send &amp; Stay
                    </button>
                </div>
                <div>
                    <button class="order-management-button-print" onclick="alert('SENDING ORDER &amp; EXITING...'); logOut();" value="SendExit" onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                        Send &amp; Exit                        
                    </button>
                </div>
                <div>
                    <form id="delete" method="post" action="order-creation.php">
                        <input type="hidden" name="delete">
                        <button type="submit" form="delete" class="order-management-button-delete" value="Delete Last" 
                        onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                                Delete Last
                        </button>
                    </form>            
                </div>
                <div>
                    <button class="order-management-button-finish" onclick="alert('PRINTING ORDER...');" value="Print Order" 
                    onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                        Print Order
                    </button>
                </div>
                <div>
                    <button class="order-management-button-exit" onclick="alert('EXITING...');logOut();" value="Exit" 
                    onmousedown="handleStyleDown(this);" onmouseup="handleStyleUp(this);">
                        Exit
                    </button>
                </div>
            </div>
        </div>
    </div>    
    <script type="text/javascript">
        function loadButtonStyles() {
            var currentCategory = "<?php echo $_SESSION["category"]; ?>";
            console.log(currentCategory);   

            /*        
                $_SESSION["category"] = "Drinks";
            } else if (isset($_POST["appetizers"])) {
                $_SESSION["category"] = "Appetizers";
            } else if (isset($_POST["entrees"])) {
                $_SESSION["category"] = "Entrees";
            } else if (isset($_POST["desserts"])) {
                $_SESSION["category"] = "Desserts";
            } else if (isset($_POST["sides"])) {
                $_SESSION["category"] = "Sides";
            } else if (isset($_POST["promos"])) {
                $_SESSION["category"] = "Promos";

drink
apps
entrees
desserts
sides
promos
            */

            if(currentCategory == "Drinks") {
                console.log('Drinks os the cat');
                handleStyleDown(document.getElementById("apps"));
                console.log('Just called handle on apps');
                console.log('calling handle on entrees');
                handleStyleDown(document.getElementById("entrees"));
                console.log('Just called handle on entrees');
                console.log('calling handle on desserts');
                handleStyleDown(document.getElementById("desserts"));
                console.log('Just called handle on desserts');
                console.log('calling handle on sides');
                handleStyleDown(document.getElementById("sides"));
                console.log('Just called handle on sides');
                console.log('calling handle on promos');
                handleStyleDown(document.getElementById("promos"));
                console.log('Just called handle on promos');
            }
        }
    </script>
</body>
</html>