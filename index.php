<?php
	include "config.php";
	if (!empty($_POST['form_email'])) {
		$form_name=$_POST['form_name'];
		$form_email=$_POST['form_email'];
		$form_password=$_POST['form_password'];
		
		/*//img version 1.0
		$destination	='images/'.uniqid().date('Y-m-d-H-i-s').$_FILES['form_file']['name'];
		$file_temp_name	=$_FILES['form_file']['tmp_name'];
		move_uploaded_file($file_temp_name, $destination);
		//end v1.0*/

		//img version 2.0
		$file=$_FILES['form_file'];
		//$file_name= $file['name'];
		$file_type= $file['type'];
		$file_size= $file['size'];
		$file_path= $file['tmp_name'];
        $RandomNum   = rand(0, 9999999999);
        $ImageName      = str_replace(' ','-',strtolower($file['name']));
        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt = str_replace('.','',$ImageExt);
        $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
        $target_dir='images/'.$NewImageName;
		move_uploaded_file($file_path, $target_dir);
		//end v2.0

		$sql="insert into user values('','$form_name','$form_email','$form_password','$target_dir')";
		$result=mysql_query($sql, $link);
		if($result){
			echo 'User Creaded Successfully';
		}else{
				echo 'Failed to create user';
			}

			//img view/block
				{
					$sql="select photo from user";
					$obj=mysql_query($sql);
					while($row=mysql_fetch_array($obj)){
						echo '<img src="'.$row['photo'].'" alt="img">';
					}
				}


	}else{	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <div class="container">
    	<div class="row well">
    		<div class="col-md-8 col-md-offset-2">
    			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"  method="POST">
					  <div class="form-group">
					    <label for="exampleInputEmail1">Full Name</label>
					    <input type="text" name="form_name" class="form-control" id="exampleInputEmail1" placeholder="Full name">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email address</label>
					    <input type="email" name="form_email" class="form-control" id="exampleInputEmail1" placeholder="Email">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" name="form_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputFile">Image</label>
					    <input type="file" name="form_file" id="exampleInputFile">
					  </div>
					  <button type="submit" class="btn btn-default">Submit</button>
				</form>
    		</div>
    	</div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php } ?>
