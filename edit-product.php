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
                echo '<td 	No Record Found!</td>';
            echo '</tr>';
                }
           
   	}

   	else{
   		echo 'ERROR: Could not execute your request.';
   	}
   	require ('close-connection.php');  
	
	if(isset($_POST['btnUpdate'])){
		$name = htmlspecialchars($_POST['txtname']);
		$price = htmlspecialchars($_POST['txtprice']);
		$description = htmlspecialchars($_POST['txtdescription']);
		$photo1 = htmlspecialchars($_POST['txtphoto1']);
		$photo2 = htmlspecialchars($_POST['txtphoto2']);

		$err = [];

		if(empty($err)){
			require('open-connection.php');

				$strSql = "
							UPDATE tbl_products SET
								name = '$name',
								description = '$description',
								price = '$price',
								photo1 = '$photo1',
								photo2 = '$photo2'
							WHERE id = ".$_SESSION['k'];

			if(mysqli_query($con, $strSql))
				header('location:product.php');
			
			else
				echo 'ERROR: Failed to Update Record!';

			require ('close-connection.php');
		}
		
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="static-login.css">
	<title>Edit Product</title>

</head>
<body>
	<div class="container">
		<div class="col-10 mt-5" >
                <h1><i class="fa fa-store"></i> Learn IT Easy Online Shop</h1>
            </div>
		<hr>


		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
						<header class="card-header">
							<h4 class="card-title mt-2">Edit Product</h4>
						</header>
					<article class="card-body">

						<form method="post">
						<div class="form-row">
							<div class="col form-group">
								<label>Product name </label>   
							  	<input class="form-control" type="text" name="txtname" id="txtname" placeholder="" value="<?php echo (isset($recProducts['name']) ? $recProducts['name'] : ''); ?>" required>
							</div> <!-- form-group end.// -->
							<div class="col form-group">
								<label>Price</label>
							  	<input class="form-control" type="Number" name="txtprice" id="txtprice" placeholder="" value="<?php echo (isset($recProducts['price']) ? $recProducts['price'] : ''); ?>" required>
							</div> <!-- form-group end.// -->
						</div> <!-- form-row end.// -->
						<div class="form-group">
							<label>Description</label>
  							<textarea class="form-control" name="txtdescription" id="txtdescription" rows="4" required><?php echo (isset($recProducts['description']) ? $recProducts['description'] : ''); ?></textarea>
						</div> <!-- form-group end.// -->
						<div class="form-row">
							<div class="form-group col-md-6">
							  <label>Photo 1</label>
							  <input type="text" class="form-control" name="txtphoto1" id="txtphoto1" placeholder="" value="<?php echo (isset($recProducts['photo1']) ? $recProducts['photo1'] : ''); ?>" required>
							</div> <!-- form-group end.// -->
							<div class="form-group col-md-6">
							  <label>Photo 2</label>
							  <input type="text" class="form-control" name="txtphoto2" id="txtphoto2" placeholder="" value="<?php echo (isset($recProducts['photo2']) ? $recProducts['photo2'] : ''); ?>" required>
							</div> <!-- form-group end.// -->
						</div> <!-- form-row.// -->
						<div class="form-row">
							<div class="form-group col-md-6">
							  <button type="submit" class="btn btn-primary btn-block" name="btnUpdate">Update Product</button>
							</div> <!-- form-group end.// -->
							<div class="form-group col-md-6">
							   <a href="product.php" class="btn btn-danger btn-block">Cancel/Go Back</a>
							</div> <!-- form-group end.// -->
						</div> <!-- form-row.// -->
					</form>
					</article> <!-- card-body end .// -->
				</div> <!-- card.// -->
			</div> <!-- col.//-->
		</div> <!-- row.//-->
	</div> 
	<!--container end.//-->

	<br><br>
	</article>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>