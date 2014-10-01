<?php

/*
Author : Jenson M John : http://jenson.in/iblog/about-2/
Licensed Under GPL (www.gnu.org/licenses/gpl-2.0.html)

login.php

*/

session_start();

spl_autoload_register(function ($myClass) {
    include_once 'classes/' . $myClass . '.class.php';
});

	if(isset($_REQUEST['exit'])==1)
	{
		$_SESSION = array();
		session_destroy();
	}  
	
if(isset($_POST['submit']))
{
   $objLastFm = new lastfm();
  
      
    $pdo = $objLastFm->getPdoObj();  	   
	
	$input['pdo'] = $pdo;
	$input['uname'] = $_POST['uname'];
	$input['passwd'] = $_POST['passwd'];
	
	$result_array = $objLastFm->validateUser($input);
	
	
	if(count($result_array)==1)
	 {
	   $_SESSION['uname'] = $result_array[0]['uname'];
	   $_SESSION['uid'] = $result_array[0]['id'];
	   header("Location: index.php");
	   exit;
	 }
	 else
	 {
	   $invalidUser = 1;
	 }
} 

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="Jenson M John">
    <!--<link rel="shortcut icon" href="../../assets/ico/favicon.ico">-->

	

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

   
 
 
  <title>last.fm Login</title>
 
  <meta name="description" content="last.fm" />
  <meta name="keywords" content="last.fm" />	 
  
  
  <!-- Bootstrap core JavaScript
    ================================================== -->
    
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  <script>
  
  
   
   </script>
   
   <style>
	   td, th {
		padding: 5px;
	  }
   </style>
   
  </head>

  <body>
  
  
  <!-- Begin page content -->
    <div class="container" style="min-height:555px;">
      <div class="page-header">
     
	
    <h2>Login</h2>
    
    
	
	</div>
     
<form name="last_fm_login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

	
	
	
		 <?php
		  if((isset($_POST['submit']) && $invalidUser==1) || isset($_REQUEST['invalid'])==1)
		  {
		 ?>
		 <h3 style="color:red">Sorry, Invalid User!</h3>
		 <?php } ?>

		<div class="row">
					  
					  
					  <div class="col-lg-4">
						
						Username : <input type="text" style="width:200px;height:30px;font-size:20px" placeholder="Enter Username" id="uname" name="uname" size="29" value="<?php if(isset($uname)) echo $uname; ?>" required />
						
					  <br/><br/>
						
						Password : <input type="text" style="width:200px;height:30px;font-size:20px" placeholder="Enter Password" id="passwd" name="passwd" size="29" value="<?php if(isset($passwd)) echo $passwd; ?>" required />
						
					 <br/><br/>

					<span style="padding-left: 115px;"><input type="submit" class="btn btn-primary" name="submit" id="submit" value="Let Me In!"/></span>
						
					  </div>
					  
					
		</div>
		
 </form>
 
</div>


 </body>
</html>

