<?php
 include('config/db_connect.php');
if(isset($_POST['delete'])){
	$idt = mysqli_real_escape_string($connect,$_POST['Delete']);

	$sql = "DELETE FROM burger WHERE id = $idt";

	if(mysqli_query($connect, $sql)){
      
      header('Location: index.php');
	}
	else{
		echo "query error :".mysqli_error($connect);
	}
}

 if(isset($_GET['id'])){
   $id = mysqli_real_escape_string($connect, $_GET['id']);
   $sql = "SELECT * FROM burger WHERE id = $id";
   $result = mysqli_query($connect,$sql);

   $burger = mysqli_fetch_assoc($result);
  
   mysqli_free_result($result);
   mysqli_close($connect);

}


?>

<!DOCTYPE html>
<html>
<?php include('header.php');?>

<div class="container center">
	<?php if($burger){ ?>
		<h4><?php echo htmlspecialchars($burger['title']) ?></h4>
		<p>Created by : <?php echo htmlspecialchars($burger['email']); ?></p>
		<p><?php echo date($burger['made']); ?></p>
		<h5>Ingredients: </h5>
		<p><?php echo htmlspecialchars($burger['ingredients']); ?></p>
			<form action="details.php" method="POST">
		<input type="hidden" name="Delete" value="<?php echo $burger['id'] ?>">
		<input type="submit" name="delete" value ="Delete" class="btn brand ">
    
	</form> 
	<?php } else { ?>
		<h4>No data present for this id</h4>
	<?php } ?>	

</div>
<?php include('footer.php') ?>
</html>