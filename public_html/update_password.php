<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Create New Password</title>
</head>
<body>

    <h1>Create New Password</h1>
    <div id="content">
        <form action="#" method="post">

            <div id="login">
                <label>Username:</label>
                <input type="text" name="username"/><br/>
                
                <label>New Password:</label>
                <input type="password" name="password"/><br/>

                <label>Confirm New Password:</label>
                <input type="password" name="password_confirm"/><br/>
            </div>

            <div id="buttons">
                <input type="submit" value="Change Password" /><br/>
            </div>
        </form>
        
    </div>
	
	<?php
	    if ( !empty($_POST) ) {
            
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            $password_confirm = filter_input(INPUT_POST, 'password_confirm');
            
            if ($password_confirm != $password) {
                
                echo '<h1> Passwords do not match, please re-enter </h1>';
                
            } else {
            
            $password = sha1($password);
            
            $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
            $dbs = $pdo->prepare('update user_table set password = :password where username= :username'); 
            
            $dbs->bindParam(':username', $username, PDO::PARAM_STR);
            $dbs->bindParam(':password', $password, PDO::PARAM_STR);
                
            if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
                    header('Location:login.php');
            } else {
                    echo '<h1> Password Not Updated </h1>';
            }
            
        }
            }
	?>

</body>
</html>