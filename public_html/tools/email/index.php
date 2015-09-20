<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/email/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
        <script>
            $(function(){
                $(".browse_email").on('click',function(){
                    $("#content").load("tools/email/browse_emails.php?cid=" + $("input[name=email_contact_id]").val());
                })
            })
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

<!--            <div id="link_browse_emails">-->
                <?php
                $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
                $dbs = $pdo->prepare('select * from contact_table');
                $contacts = array();

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
                
            <!--</div>-->

        <script type="text/javascript" src="on_load.js"></script>

    </body>

</html>