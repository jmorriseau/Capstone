<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Security Question</title>
</head>
<body>

    <h1>Security Question</h1>
        <form action="#" method="post">

            <!-- Ask security question for forgot password-->
            <div id="security_question">
                <label>What is your daughter's middle name?:</label>
                <input type="text" name="security_q"/><br/>
            </div>

            <div id="buttons">
                <input type="submit" value="Submit" />
            </div>

        </form>
    
        <!-- If an answer is input, set the value to a variable and check against the db-->
    	<?php
	    if ( !empty($_POST) ) {
            
            $security_q = filter_input(INPUT_POST, 'security_q');
            
            
            $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
            $dbs = $pdo->prepare('select * from user_table where security_q = :security_q'); 
            
            $dbs->bindParam(':security_q', $security_q, PDO::PARAM_STR);
             
            //if answer is valid send to update_password.php, if invalid alert the user
            if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
                    header('Location: update_password.php');
            } else {
                    echo '<h1> Invalid Answer! </h1>';
            }
            
        }
	
	?>

    </body>
</html>