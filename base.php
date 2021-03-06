<html>
  <head></head>
  <body>
    <?php
	$host = 'localhost';
		$user = 'root';
		$password = 'cyberbullying';
		$db_name = 'loob';
		$link = mysqli_connect($host, $user, $password, $db_name);
	
	function get_comments($name){
		global $link;
		$sql = "SELECT * FROM teachers WHERE teacher = '$name'";
		$result = $link->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			$all = $row["comments"];
		  }
		  $array = explode('^^^', $all);
		  return $array;
		}
	}
	
	function get_all(){
		global $link;
		
		$sql = "SELECT * FROM teachers ORDER BY point DESC";
		$result = $link->query($sql);

		if ($result->num_rows > 0) {
		  $array = array();
		  while($row = $result->fetch_assoc()) {
			$array[$row["teacher"]] = array($row["point"], $row["point_count"], get_comments($row["teacher"]));
		  }
		  return $array;
		}
	}
	function get_point($name){
		global $link;
		$sql = "SELECT * FROM teachers WHERE teacher = '$name'";
		$result = $link->query($sql);

		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
			return $row["point"];
		  }
		}
	}
	
	function add_teacher($name){
		global $link;
		
		$result = "INSERT INTO teachers (teacher, point, comments) VALUES ('$name', '0', '')";
		if(mysqli_query($link, $result)){
			echo("   complete");
		}
		else{
			echo "Error: " . $result . "<br>" . mysqli_error($link);
		}
	}
	function set_point($point, $name){
		global $link;
		
		$result = "UPDATE teachers SET point='$point' WHERE teacher='$name'";
		
		if(mysqli_query($link, $result)){
			echo("   complete");
		}
		else{
			echo "Error: " . $result . "<br>" . mysqli_error($link);
		}
	}
	
	function set_point_count($point_count, $name){
		global $link;
		
		$result = "UPDATE teachers SET point_count='$point_count' WHERE teacher='$name'";
		
		if(mysqli_query($link, $result)){
			echo("   complete");
		}
		else{
			echo "Error: " . $result . "<br>" . mysqli_error($link);
		}
	}
	
	function add_comment($comment, $name){
		global $link;
		$comments = get_comments($name);
		if($comments != ''){
			$sum_comment = $comments . "^^^" . $comment ;
		}
		else{
			$sum_comment = $comment ;
		}
		$result = "UPDATE teachers SET comments='$sum_comment' WHERE teacher='$name'";
		
		if(mysqli_query($link, $result)){
			echo("   complete");
		}
		else{
			echo "Error: " . $result . "<br>" . mysqli_error($link);
		}
	}
	get_all();
	?>
  </body>
</html>