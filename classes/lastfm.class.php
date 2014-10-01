<?php

/*
Author : Jenson M John : http://jenson.in/iblog/about-2/
Licensed Under GPL (www.gnu.org/licenses/gpl-2.0.html)

Class lastfm{}

*/

class lastfm{
  
  public function getPdoObj()
  {
    $pdo = new PDO('mysql:host=localhost;dbname=YOUR_DB_NAME', "YOUR_DB_USERNAME", "YOUR_DB_PASSWORD", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8")); 
    return $pdo;
  }
  
  public function validateUser($input)
  {
     
	    $sql = 'SELECT id,uname FROM last_fm_user WHERE uname= :uname AND passwd= :passwd';
		
		$prepare = $input['pdo']->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		
		$prepare->execute(array(':uname' => $input['uname'], ':passwd' => md5($input['passwd'])));
		
		$result_array = $prepare->fetchAll();
		
		return $result_array;
  
  }
  
  public function getTracks($q, $pdo, $uid)
  {  
 
	   $search_url = "http://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&artist=".$q."&api_key=5a59a5f886dde6fd0a13e3192e0a4e56&format=json";
		
	   $this->saveSearch($q, $pdo, $uid);
	   
	   $json = file_get_contents($search_url);
		
	   return json_decode($json, true);
  }	
  
  public function getSimilarArtists($q)
  {  
 
	   $search_url = "http://ws.audioscrobbler.com/2.0/?method=artist.getsimilar&artist=".$q."&api_key=5a59a5f886dde6fd0a13e3192e0a4e56&format=json";
		
	   $json = file_get_contents($search_url);
		
	   return json_decode($json, true);
  }
  
  public function saveSearch($q, $pdo, $uid)
  {
		$stmt = $pdo->prepare("INSERT INTO last_fm_user_search (uid, keyword, time) VALUES (:uid, :keyword, :time)");
	    
		$time = date("Y-m-d H:i:s");
		
		$q = urldecode($q);
		
		$stmt->bindParam(':uid', $uid);
		$stmt->bindParam(':keyword', $q);
		$stmt->bindParam(':time', $time);
        
		$stmt->execute();
  }
  
   public function searchHistory($pdo, $uid)
   {
     
	    $sql = 'SELECT DISTINCT keyword FROM  last_fm_user_search WHERE uid= :uid ORDER BY id DESC LIMIT 0,7';
		
		$prepare = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		
		$prepare->execute(array(':uid' => $uid));
		
		$result_array = $prepare->fetchAll();
		
		return $result_array;
  
   }
  

}

?>