<?php     
    include('connection.php');  

	if(isset($_POST['but_submit'])){

		$username = $_POST['user'];  
		$password = $_POST['pass'];  

			//to prevent from mysqli injection  
			$username = stripcslashes($username);  
			$password = stripcslashes($password);  
			$username = mysqli_real_escape_string($conn, $username);
			$password = mysqli_real_escape_string($conn, $password);  

			$sql = "select *from users where user = '$username' and pass = '$password'";  
			$result = mysqli_query($conn, $sql);  
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
			$count = mysqli_num_rows($result);  

			if($count == 1){  
				$_SESSION['user'] = $username;
				header('Location: app.php');
			}  
		}

		if(isset($_POST['signUpGo'])){

				$newUsername = $_POST['newUsername'];  
				$newPassword = $_POST['newPassword'];  

					//to prevent from mysqli injection  
					$newUsername = stripcslashes($newUsername);  
					$newPassword = stripcslashes($newPassword);  
					$newUsername = mysqli_real_escape_string($conn, $newUsername);
					$newPassword = mysqli_real_escape_string($conn, $newPassword);   
					
					$sql = "select *from users where user = '$newUsername'";  
					$result = mysqli_query($conn, $sql);  
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
					$count = mysqli_num_rows($result);  
					echo $count;

					if($count == 0){  
						$sql = "INSERT INTO users (`user`, `pass`, `tableString`) VALUES ('$newUsername', '$newPassword', '')"; 
						mysqli_query($conn, $sql);
						$_SESSION['user'] = $newUsername;
						header('Location: app.php');
					}  
				}
?>  

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Earthshine: a Moon Journal App</title>
<link href="landing.css" rel="stylesheet" type="text/css">
<link href="starSky.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.typekit.net/vos4vji.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script language="javascript">	
		$(document).ready(function(){
			var elementSignIn = document.getElementById("signInButton"); 
			var elementSignUp = document.getElementById("signUpButton");
			var goToSU = document.getElementById("goToSU");
			var goToSI = document.getElementById("goToSI");
			var head = document.getElementById("head");
			
			elementSignIn.onclick = function(){
				$('#home').css("visibility", "hidden")
				$('#signIn').css("visibility", "visible")
			}
			elementSignUp.onclick = function(){
				$('#home').css("visibility", "hidden")
				$('#signUp').css("visibility", "visible")
			}
			goToSU.onclick = function(){
				$('#signIn').css("visibility", "hidden")
				$('#signUp').css("visibility", "visible")
			}
			goToSI.onclick = function(){
				$('#signUp').css("visibility", "hidden")
				$('#signIn').css("visibility", "visible")
			}
			head.onclick = function(){
				$('#signUp').css("visibility", "hidden")
				$('#signIn').css("visibility", "hidden")
				$('#home').css("visibility", "visible")
			}
		})
	</script>
	
</head>

	
	
<body>
	<div class="container">
		<div class="stars"></div>
		<div class="stars1"></div>
		<div class="stars2"></div>
	
	<div class="partContainer">
		<span class="dot">
			<span class="scaleMoon">
				<div class="moon"></div>
			</span>
		</span>
		<div class="rightBox">
			
			<div class="home" id="home" style="visibility: visible;">
				<div class="button" id="signInButton" style="left: 22px; bottom: 20px;">sign in</div>
				<div class="button" id="signUpButton" style="right: 22px; bottom: 20px;">sign up</div>
				<div class="blurb"> An educational webapp that lets you journal what the moon looks like every night</div>
			</div>
			
			<div class="signIn" id="signIn" style="visibility: hidden;">
				<div class="spacing"></div>
				    <form name="f1" onsubmit = "return validation()" method = "POST">  
					<label for="username">Username</label>
					<input type="text" id="user" name="user" placeholder="enter your username">

					<label for="password">Password</label>
					<input type="password" id="pass" name="pass" placeholder="enter your password">

					<input type="submit" name="but_submit" id="but_submit" value="log in">
  				</form>
				<div class="swap" id="goToSU">
					dont have an account?<br>
					<u>get started</u>
				</div>
			</div>
			
			
			<script>  
            function validation()  
            {  
                var id=document.f1.user.value;  
                var ps=document.f1.pass.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
        </script>  
			
			
			<div class="signUp" id="signUp" style="visibility: hidden;">
				<form name="f2" onsubmit = "return signValidation()" method = "POST">
					<label for="newUsername">Username</label>
					<input type="text" id="newUsername" name="newUsername" placeholder="choose your username">

					<label for="newPassword">Password</label>
					<input type="password" id="newPassword" name="newPassword" placeholder="choose your password">

					<input type="submit" name="signUpGo" id="signUpGo" value="sign up">
  				</form>
				<div class="swap2" id="goToSI">
					already have an account?<br>
					<u>sign in</u>
				</div>
			</div>
			
			<script>  
            function signValidation()  
            {  
                var id=document.f2.newUsername.value;  
                var ps=document.f2.newPassword.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
        </script>  
			
		</div>
		<div class="topBox" id="head">
			<h1 class="shadow">Earthshine</h1>
		</div>
	</div>
	<br>
	</div>
</body>
</html>
