<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/email/main.css" />
    </head>
    <body>        
        <?php
        
        $contact_id = $_GET['cid'];
        
        $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
        $dbs = $pdo->prepare('select * from email_table where contact_id = :contact_id');
        $dbs->bindParam(':contact_id', $contact_id, PDO::PARAM_STR);
      
        $emails = array();

        if ($dbs->execute() && $dbs->rowCount() > 0) {
            $emails = $dbs->fetchAll(PDO::FETCH_ASSOC);

            foreach ($emails as $email) {
                echo '<div class="tool_content">';
                echo '<h2 class="tool_name">'. 'Company Emails' . '</h2>';

                echo '<p>' . $email["email_subject"] . '<br />';
                echo $email["email_date_sent"] . '<br />';
                echo $email["attachment_blog"] . '</p>';

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo 'No company emails found';
        }
        ?>

    <!--<script type="text/javascript" src="tools/email/emails.js"></script>-->

    </body>

</html>