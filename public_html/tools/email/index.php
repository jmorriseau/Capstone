<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/email/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
    </head>
    <body>

        <div id="email_header">
            <h2>Please select an email below to begin.</h2>
        </div>

        <div id="email_content">

            <div id="link_add_email">
                <a href="#"><h2>Add Email</h2>
                    <i class="fa fa-plus fa-5x"></i></a>
            </div>

            <div id="link_browse_emails">
                <?php
                $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
                $dbs = $pdo->prepare('select * from contact_table');
                $contacts = array();

                if ($dbs->execute() && $dbs->rowCount() > 0) {
                    $contacts = $dbs->fetchAll(PDO::FETCH_ASSOC);
                    
                                     

                    foreach ($contacts as $contact) {
                        echo '<table><thead>';
                        echo '<tr><th>' . 'Browse Company Emails' . '</th></tr></thead>';

                        echo '<tbody><tr> <td>' . $contact["company_name"] . '</td> </tr></tbody>';
                        //This isn't working, need a way to pass company name to browse emails
//                        echo '<input type="hidden" name="company_name" value="Bottomline Technologies" />';

                        echo '</table>';
                    }
                    
                } else {
                    echo 'No company emails found';
                }
                ?>
                
            </div>
        </div>

        <script type="text/javascript" src="on_load.js"></script>

    </body>

</html>