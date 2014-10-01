<?php

/*
Author : Jenson M John : http://jenson.in/iblog/about-2/
Licensed Under GPL (www.gnu.org/licenses/gpl-2.0.html)

index.php

*/

session_start();
error_reporting(0);
$uname = $_SESSION['uname'];
$uid = $_SESSION['uid'];

if(trim($uname)=="")
{
  header("Location: login.php?invalid=1");
  exit;
}

spl_autoload_register(function ($myClass) {
    include_once 'classes/' . $myClass . '.class.php';
});

  
  
  $objLastFm = new lastfm();
  
  $pdo = $objLastFm->getPdoObj();
  
  $search_history = $objLastFm->searchHistory($pdo, $uid);
  
if(isset($_POST['submit']))
{
  
    $q = trim(urlencode($_POST['q']));
	
	$artist_music_arr = $objLastFm->getTracks($q, $pdo, $uid);
	
	$artist_similar = $objLastFm->getSimilarArtists($q);
	
	
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

   
 
 
  <title>last.fm Suggestion Home</title>
 
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
 
 .musicTracks, .similarArtists {
    padding: 15px;
  }
  
  .keywords {
    background-color: #97f4a4;
	color: black;
}
   </style>
  
  <script>
  $(document).ready(function(){
		$('.keywords').on('click',function(){
		$('#q').val($(this).html());
	});
  });  
  </script>
  
  </head>

  <body>
  
  
  <!-- Begin page content -->
    <div class="container" style="min-height:555px;">
      <div class="page-header">
     
	
       <h2>Last.fm Suggestion</h2>
        <div id="welcomeDiv">
		<?php
		if(count($search_history)>0)
		{?>
			<span id="searchHistory">
			My Recent Searches : 
			<?php
			for($i=0; $i<count($search_history); $i++)
			{
			?>
			<a href="javascript:void();" class="keywords"><?php echo urldecode($search_history[$i]['keyword']); ?></a>
		<?php } ?>
		   </span>
	  <?php } ?>	   
		<span id="logoutSpan" style="padding-left:300px;"><strong>Hi <?php echo $uname; ?>! <a href="login.php?exit=1">Logout</a></strong></span>
		
		</div>
    </div>
     
<form name="last_fm_search" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

	
	 
		 <div class="row">
					  
					  
					  <div class="col-lg-4">
						
						<input type="text" style="width:350px;height:35px;font-size:25px" placeholder="Enter Artist Name" id="q" name="q" size="29" value="<?php if(isset($q)) echo urldecode($q); ?>" required>
					  </div>
					  
					  <div class="col-lg-2">
						 <span><input type="submit" class="btn btn-primary" name="submit" id="submit" value="Search!"/></span>
					  </div>
					  
							  
	    </div>
		
</form>
 
 <?php
 
 if(isset($_POST['submit']))
 {?>
<div id="resultsDiv"> 
	
	<div id="musicTracksDiv" style="float:left; width:50%">
	 
	  <h2><em><?php echo urldecode(ucwords($q)); ?></em> Tracks</h2>
	 <?php
	 if(count($artist_music_arr['toptracks']['track'])>0)
	   {
		 for($i=0;$i<count($artist_music_arr['toptracks']['track']);$i++)
		 {
		 ?>
		 
		 <div class="musicTracks">
		  
		  <?php if(isset($artist_music_arr['toptracks']['track'][$i]['image'][1]['#text'])) { ?> <img src="<?php echo $artist_music_arr['toptracks']['track'][$i]['image'][1]['#text']; ?>" border="0"/>&nbsp; <?php } ?><a href="<?php echo $artist_music_arr['toptracks']['track'][$i]['url']; ?>" target="_blank"><?php echo $artist_music_arr['toptracks']['track'][$i]['name']; ?></a>
		</div>
		 
		 <?php 
		  }
		} 
		  else
          {	  
		  ?>
	         <div style="color:red"><h2>Sorry, No Results..:(</h2></div>
		 <?php 
		  } 
	  ?>
		  
		  
	</div>
	
	<div id="similarArtistsDiv">
	
	 <h2>Similar Artists</h2>
	 
	 <?php
	 if(count($artist_similar['similarartists']['artist']>0) && isset($artist_similar['similarartists']['artist'][0]['name']))
	   {
	  
		 for($i=0;$i<count($artist_similar['similarartists']['artist']);$i++)
		 {
		 ?>
		 
		 <div class="similarArtists">
		  
		  <?php if(isset($artist_similar['similarartists']['artist'][$i]['image'][1]['#text'])) { ?> <img src="<?php echo $artist_similar['similarartists']['artist'][$i]['image'][1]['#text']; ?>" border="0"/>&nbsp; <?php } ?><a href="<?php echo $artist_similar['similarartists']['artist'][$i]['url']; ?>" target="_blank"><?php echo $artist_similar['similarartists']['artist'][$i]['name']; ?></a>
		</div>
		 
		 <?php 
		  }
	  }
      else
       {	  
	  ?>
	   <div style="color:red"><h2>Sorry, No Results..:(</h2></div>
	 <?php } ?> 
	</div>

</div>
 <?php
 } ?>
 
</div>


 </body>
</html>

