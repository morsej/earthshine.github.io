<?php
	include "connection.php";

	if(!isset($_SESSION['user'])){
		header('Location: index.php');
	}

	if(isset($_POST['moon_submit'])){
		$phase = $_POST['phase'];  
		$base = $_POST['base'];  
		$date = $_POST['date'];  
		$time = $_POST['time'];  
		
		$tableString = "<tr><td><div class=\"smalldot\"><div class=\"smallMoon\" style=\"--smallBase: " . $base . "; --smallPhase: -";
		
		if ($phase > 50){
			$phase = $phase - (($phase - 50) * 2);
			$tableString = $tableString . $phase . "s; transform: scale(-.3);\">";
		}else{
			$tableString = $tableString . $phase . "s;\">";
		}
		
		$tableString = $tableString . "</div></div></td><td>" . $date . "</td><td>" . $time . "</td></tr>";
		
		$thisUser = $_SESSION['user'];
		$sql = "SELECT tableString FROM users WHERE user = '$thisUser'";  
		$table = mysqli_query($conn, $sql);  
						
		$row = mysqli_fetch_array($table);
		$tableHTML = implode($row);
		$length = strlen($tableHTML) / 2;
		$cut = substr($tableHTML, 0, -$length); 
		
		$tableString = $tableString . $cut;
		
		$update = "UPDATE users SET tableString = '$tableString' WHERE user = '$thisUser'";
				
		mysqli_query($conn, $update);
		
		
	}
	
	if(isset($_POST['log_out'])){
			session_destroy();
			header('Location: index.php');
		}
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Earthshine: a Moon Journal App</title>
	<link href="app.css" rel="stylesheet" type="text/css">
	<link href="smallMoon.css" rel="stylesheet" type="text/css">
	<link href="starSky.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.typekit.net/vos4vji.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script>
		//layout taken from get_weather_ajax from class
	   function getTemp() {
		   /* Step 1: Make instance of request object...
		   ...to make HTTP request after page is loaded*/
		   request = new XMLHttpRequest();
		   
		   request.open('GET', 'https://goweather.herokuapp.com/weather/Boston', true);
		   // Step 2: set up event handler/callback
		   request.onreadystatechange = function(){
			   if (request.readyState == 4){
				   if (request.status == 200){
					   weather = JSON.parse(request.responseText);
					   today = weather['temperature'];
			   
					   document.getElementById("api").innerHTML = "Today's Weather in Boston: " + today;
					   
				   } else {
					   console.log("Status error: " + request.status);
				   }
			   } else {
				   console.log("Ignored readyState: " + request.readyState);
			   }
		   }
		   
		   request.send();
	   }
	   
   </script>
	
   <script language="javascript">
	
   </script>
</head>
	
<body onload= "getTemp()">
	
	<div class="container">
		<div class="stars"></div>
		<div class="stars1"></div>
		<div class="stars2"></div>
	
	<div class="partContainer">
		<div class="dotbox">
			<span class="dot">
				<span class="scaleMoon">
					<div class="moon" id="adjustMoon"></div>
				</span>
			</span>
			
			<div class="slidecontainer" >
				<form method = "POST">
				<div class="controls">
				    <input type="range" min="0" max="100" value="12" class="slider" id="phase" name ="phase">
				    <br>
				    <input type="color" id="base" name="base" value="#fdfdbe">
				</div>
				<input type="date" id="date" name="date"
      			 		value="2021-12-16"
       					min="2020-12-16" max="2025-12-16">
				<input type="time" id="time" name="time" min="01:00" max="24:59" value="22:37">
				<br><br>
				<button name="moon_submit" id="moon_submit" class="button" id="signUpButton">log this moon</button>
				
			</form>
			</div>
		</div>
		
		<div class="rightBox">
			<div class="spacing"></div>
			<div class="box">
				
				 <table>
					<colgroup>
						<col span="1" style="width: 40px;">
					    <col span="1" style="width: calc(75% - 40px);">
						<col span="1" style="width: 25%">
					</colgroup>
					
					<tbody>
						<?php
							include('connection.php');  
						
							$thisUser = $_SESSION['user'];
							$sql = "SELECT tableString FROM users WHERE user = '$thisUser'";  
							$table = mysqli_query($conn, $sql);  
						
							$row = mysqli_fetch_array($table);
							$tableHTML = implode($row);
							$length = strlen($tableHTML) / 2;
							$cut = substr($tableHTML, 0, -$length); 
								
						
							print_r($cut);
						?>
						
					</tbody>
					 
				</table>
				<form method='post' action="">
					<button name="log_out" id="log_out" class="button" id="signUpButton" style="top:0px;">log out</button>
				</form>
			</div>
			
			<div class="api" id = "api">	
				api fun fact!
			</div>
			<!---
			<div class = "moonfact" id = "moonfact">
				Moon fact!
			</div>
			--->
			
		</div>
		
		<div class="topBox" id="head">
			<h1 class="shadow">Earthshine</h1>
		</div>
	</div>
	<br>
	<script   language="javascript">
		 const inputs = [].slice.call(document.querySelectorAll('.controls input'));

      // listen for changes
      inputs.forEach(input => input.addEventListener('change', handleUpdate));
      inputs.forEach(input => input.addEventListener('mousemove', handleUpdate));

      function handleUpdate(e) {
		var moon = document.getElementById('adjustMoon');
        // append 'px' to the end of spacing and blur variables
		var amount = this.value;
		if(amount > 50 && this.id != 'base'){
			amount = amount - ((amount - 50) * 2)
			
			moon.setAttribute('style', 'transform: scale(-2);');
		}else if(this.id != 'base'){
			moon.setAttribute('style', 'transform: scale(2);');
		}
		  
		const negValue = (this.id === 'base' ? amount : amount * -1);
        const suffix = (this.id === 'base' ? '' : 's');
        document.documentElement.style.setProperty(`--${this.id}`, negValue + suffix);
}

	</script>
	</div>
</body>
</html>
