<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/email/main.css" />
    </head>
    <body>        
        <?php
        
        $company_name = 'Bottomline Technologies';
        
        $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
        $dbs = $pdo->prepare('select * from email_table where contact_id = (select contact_id from contact_table where company_name = :company_name)');
        $dbs->bindParam(':company_name', $company_name, PDO::PARAM_STR);
      
        $emails = array();

        if ($dbs->execute() && $dbs->rowCount() > 0) {
            $emails = $dbs->fetchAll(PDO::FETCH_ASSOC);

            foreach ($emails as $email) {
                echo '<table><thead>';
                echo '<tr><th>' . 'Company Emails' . '</th></tr></thead>';

                echo '<tbody><tr> <td>' . $email["email_subject"] . '</td> </tr>';
                echo '<tbody><tr> <td>' . $email["email_date_sent"] . '</td> </tr>';
                echo '<tbody><tr> <td>' . $email["attachment_blog"] . '</td> </tr></tbody>';

                echo '</table>';
            }
        } else {
            echo 'No company emails found';
        }
        ?>

    <!--<script type="text/javascript" src="tools/email/emails.js"></script>-->

    </body>

</html>