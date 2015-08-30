<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Security Question</title>
</head>
<body>

    <h1>Security Question</h1>
        <form action="#" method="post">

            <div id="security_question">
                <label>What is your daughter's middle name?:</label>
                <input type="text" name="security_q"/><br/>

            </div>

            <div id="buttons">
                <input type="submit" value="Submit" />
            </div>

        </form>
    
    	<?php
	    if ( !empty($_POST) ) {
            
            $security_q = filter_input(INPUT_POST, 'security_q');
            
            
            $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3307;", "root", "");
            $dbs = $pdo->prepare('select * from user_table where security_q = :security_q'); 
            
            $dbs->bindParam(':security_q', $security_q, PDO::PARAM_STR);
                
            if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
                    header('Location: update_password.php');
            } else {
                    echo '<h1> Invalid Answer! </h1>';
            }
            
        }
	
	?>

    </body>
</html>