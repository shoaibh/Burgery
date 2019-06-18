<?php 

include('config/db_connect.php');
$email = $name = $ing= '';
$errors = array('email' => '', 'name' => '', 'ingredients' => '' );
 if(isset($_POST['submit'])){
 if(empty($_POST['email'])){
    $errors['email']= '*email is required';
}
 else{
  $email= $_POST['email'];
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $errors['email']='*must be a valid email';
}
}
if(empty($_POST['Burger'])){
    $errors['name']= '*name is required';
}
 else{
  $name = $_POST['Burger'];
  if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
    $errors['name']= '*name should be only space and alphabets';
}
}
if(empty($_POST['ingredients'])){
    $errors['ingredients']= '*ingredients are required';
}
 else{
  $ing = $_POST['ingredients'];
  if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ing)){
    $errors['ingredients']='*ingredients should be comma separated ';
}

}
if(!array_filter($errors)){
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $name = mysqli_real_escape_string($connect, $_POST['Burger']);
    $ing = mysqli_real_escape_string($connect, $_POST['ingredients']);

    $sql = "INSERT INTO burger(title, email, ingredients) VALUES('$name','$email','$ing')";

    if(mysqli_query($connect,$sql)){
     
	header('Location: index.php');
     
    }else{
    echo 'query error : '.mysqli_error($connect);
}


}
}
?>

<!DOCTYPE html>
<html>
<?php include('header.php'); ?>
<section class="container grey-text">
	<h4 class="center" >
		Add your Burger
	</h4>
	<form class="white" action="order.php" method="POST">
		<label>Your Email :</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<label>Burger name :</label>
		<input type="text" name="Burger" value="<?php echo htmlspecialchars($name) ?>">
		<div class="red-text"><?php echo $errors['name']; ?></div>
		<label>Your ingredients :</label>
		<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ing) ?>">
		<div class="red-text"><?php echo $errors['ingredients']; ?></div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>
<?php include('footer.php'); ?>
</html>