<?php
    include 'comp/dbh.php'; 
    $message=" ";
	
    if(isset($_POST['login'])) {
		$user = mysqli_real_escape_string($conn, $_POST['user_name']);
		$pass = mysqli_real_escape_string($conn, $_POST['password']);
		
		
		$user = stripslashes($user);
		$pass = stripslashes($pass);
        
		
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username='{$user}' AND password='{$pass}';");
      
        $row  = mysqli_fetch_array($result);
      
        if(is_array($row)) {
			
			session_id("login-session");
			session_start();
			
          $_SESSION['login-true'] = true;
          $_SESSION['microcip']="";
          $_SESSION['utilizator'] = $user;
          $utilizatorCurent = $_SESSION['utilizator'];
          
          $sqlUser = "INSERT INTO utilizatori_istoric (user_name) VALUES ('$utilizatorCurent')";
          mysqli_query($conn, $sqlUser);
          
          header("Location: ./home.php");

          
        }
        else{
            $message = "Date incorecte!";
        }
    } 
    
	include 'comp/header.php';
?>
<head><link rel="stylesheet" href="style/style_login.css"></head>  

<div class="text-center content">
    <div class="login">    
        <form action="" method="POST">
            <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
            <div class="form-inp">
                <label>Nume:</label>
                <input class="inp" type="text" name="user_name" required>
            </div>
            <div class="form-inp">
                <label>Parola:</label>
                <input class="inp" type="password" name="password" required>
            </div> 
                <br>
            <button type="submit" name="login" class="btn1" id="logbtn">Conectare</button>
        </form>
        <br>
        <p style="padding: .5em; margin: 0; color: #000;">
            puteti folosi pentru test:
            <br>
            nume: <span style="color: #1da54b">admin</span> <br>
            parola: <span style="color: #1da54b">admin1</span>
        </p>
        
    </div>
</div>

<?php  include 'comp/footer.php'; ?>