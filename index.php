<?php
  include('config/db_connect.php');

  $sqll = 'SELECT id, title, ingredients FROM 
  burger ';
  
  $result = mysqli_query($connect,$sqll);
  $burger = mysqli_fetch_all($result,MYSQLI_ASSOC);
  mysqli_free_result($result);
  mysqli_close($connect);
  
 
?>
<!DOCTYPE html>
<html>
<?php include('header.php'); ?>
<h4 class="center grey-text">Burgers!</h4>
<div class="container">
	<div class="row">
		<?php foreach ($burger as $burgery ) :?>
			<div class="col s6 md3">
				<div class="card z-depth-0">
					<img src="burger.svg" class="burgerss">
					<div class="card-content center">
						<h5><?php echo htmlspecialchars($burgery['title']);?></h5>
						<ul>
							<?php foreach ( explode(' ',$burgery['ingredients']) as $i) :?>
								<li><?php echo htmlspecialchars($i); ?></li>
							<?php endforeach; ?>
						</ul>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?id=<?php echo $burgery['id']?>">more...</a>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php include('footer.php'); ?>
</html>