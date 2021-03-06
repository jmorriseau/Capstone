<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/email/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
        <script>
            $(function(){
//                if the user clicks a company folder, take them to browse the emails for that company
                $(".browse_email").on('click',function(){
                    $("#content").load("tools/email/browse_emails.php?cid=" + $(this).find("input[name=email_contact_id]").val());
                });
            });
        </script>
    </head>
    <body>

        <div class="tool_header">
            <h2>Please select an email folder below to begin.</h2>
        </div>

        <div class="tool_content">
            <div id="link_add_email">
                <a href="#">
                    <div class="tool_name">Add Email</div>
                    <div class="tool_body"><div class="icon"><i class="fa fa-plus fa-5x"></i></div></div>
                </a>
            </div>
        </div>


                <?php
                $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
                $dbs = $pdo->prepare('select * from contact_table');
                $contacts = array();

//                pull back contacts
                if ($dbs->execute() && $dbs->rowCount() > 0) {
                    $contacts = $dbs->fetchAll(PDO::FETCH_ASSOC);
                                                       
                    foreach ($contacts as $contact) {
                        echo '<div class="tool_content browse_email">';
                        echo '<h2 class="tool_name">'. $contact["company_name"] . '</h2>';
                        echo '<div class="tool_body">';
                        
                        echo '<p>' . 'View Company Emails' .'<br />';
                        echo '<input name="email_contact_id" type="hidden" value="'.$contact["contact_id"].'" />';
 
                        echo '</div>';
                        echo '</div>';
                    }
                    
                } else {
                    echo 'No company emails found';
                }
                ?>

        <script type="text/javascript" src="on_load.js"></script>

    </body>

</html>