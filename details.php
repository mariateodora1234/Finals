<?php
    session_start();
          
    if(isset($_GET['k'])){
        $_SESSION['k'] = $_GET['k'];
    }
            
    require ('open-connection.php');
    $strSql= "SELECT * FROM tbl_products WHERE id = ".$_SESSION['k'];
    

    if($rsProducts = mysqli_query($con, $strSql)){
        if(mysqli_num_rows($rsProducts) > 0){
           ($recProducts = mysqli_fetch_array($rsProducts));
               mysqli_free_result($rsProducts);
               }
        else{
            echo '<tr>';
                echo '<td   No Record Found!</td>';
            echo '</tr>';
                }
    }

    else{
        echo 'ERROR: Could not execute your request.';
    }

    if(isset($_POST['btnProcess'])) {
        if(isset($_SESSION['cartItems'][$_POST['hdnKey']][$_POST['radSize']]))
            $_SESSION['cartItems'][$_POST['hdnKey']][$_POST['radSize']] += $_POST['txtQuantity']; 
        else
            $_SESSION['cartItems'][$_POST['hdnKey']][$_POST['radSize']] = $_POST['txtQuantity']; 

        $_SESSION['totalQuantity'] += $_POST['txtQuantity'];
        header("location: confirm.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="static-login.css">
    <title>Learn IT Easy Online Shop | Shopping Cart</title>
</head>
<body>
    <form method="post">
        <div class="container">
            <div class="row mt-5">
                <div class="col-10">
                    <h1><i class="fa fa-store"></i> Learn IT Easy Online Shop</h1>
                </div>
                <div class="col-2 text-right">
                    <a href="cart.php" class="btn btn-primary">
                        <i class="fa fa-shopping-cart"></i> Cart
                        <span class="badge badge-light">
                            <?php echo (isset($_SESSION['totalQuantity']) ? $_SESSION['totalQuantity'] : "0"); ?>
                        </span>
                    </a>
                </div>            
            </div>
            <hr>

            <div class="row">
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="product-grid2 card">
                            <div class="product-image2">
                                <a href="">
                                    <img class="pic-1" src="img/<?php echo $recProducts['photo1']; ?>">
                                    <img class="pic-2" src="img/<?php echo $recProducts['photo2']; ?>">
                                </a>                            
                            </div>                        
                        </div>
                    </div>                
                    <div class="col-md-8 col-sm-6 mb-4">                
                        <h3 class="title">
                            <?php echo $recProducts['name']; ?>
                            <span class="badge badge-dark">₱ <?php echo $recProducts['price']; ?></span>
                        </h3>
                        <p><?php echo $recProducts['description']; ?></p>                    
                        <hr>
                        <input type="hidden" name="hdnKey" value="<?php echo $_GET['k']; ?>">
                        <h3 class="title">Select Size:</h3>
                        <input type="radio" name="radSize" id="radXS" value="XS" checked>
                        <label for="radXS" class="pr-3">XS</label>
                        <input type="radio" name="radSize" id="radSM" value="SM">
                        <label for="radSM" class="pr-3">SM</label>
                        <input type="radio" name="radSize" id="radMD" value="MD">
                        <label for="radMD" class="pr-3">MD</label>
                        <input type="radio" name="radSize" id="radLG" value="LG">
                        <label for="radLG" class="pr-3">LG</label>
                        <input type="radio" name="radSize" id="radXL" value="XL">
                        <label for="radXL" class="pr-3">XL</label>                        
                        <hr>
                        <h3 class="title">Enter Quantity:</h3>
                        <input type="number" name="txtQuantity" id="txtQuantity" class="form-control" placeholder="0" min="1" max="100" required>
                        <br>
                        <button type="submit" name="btnProcess" class="btn btn-dark btn-lg"><i class="fa fa-check-circle"></i> Confirm Product Purchase</button>
                        <a href="index.php" class="btn btn-danger btn-lg"><i class="fa fa-arrow-left"></i> Cancel / Go Back</a>
                    </div>                                
            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>