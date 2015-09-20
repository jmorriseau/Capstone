<!DOCTYPE html>
<!--This page is the main page for the contacts functionality-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/contacts/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
        <script>
            $(function(){
                $(".edit_contact").on("click",function(){
                    var id = $(this).data("contact");
                    $("#content").load("tools/contacts/add_contact.php?cid=" + id);
                });
            });
        </script>
    </head>
    <body>

        <div class="tool_header">
            <h2>Please select a contact below to begin.</h2>
        </div>

        <!--Link to add_contact.php-->
        <div class="tool_content">
            <div id="link_add_contact">
                <a href="#">
                    <div class="tool_name">Add Contact</div>
                    <div class="tool_body"><div class="icon"><i class="fa fa-plus fa-5x"></i></div></div>
                </a>
            </div>
        </div>

        
            <?php
            $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
            $dbs = $pdo->prepare('select * from contact_table');
            $contacts = array();

            if ($dbs->execute() && $dbs->rowCount() > 0) {
                $contacts = $dbs->fetchAll(PDO::FETCH_ASSOC);

//                Pull in existing contacts to display for the user
                
                foreach ($contacts as $contact) {
                    echo '<div class="tool_content edit_contact" data-contact="'.$contact["contact_id"].'">';
                    
                    echo '<h2 class="tool_name">'. $contact["company_name"] . '</h2>';
                    echo '<div class="tool_body">';

                    echo '<p>' . $contact["company_address_line_one"] .'<br/>';
                    echo $contact["company_address_line_two"] . '<br/>';
                    echo $contact["company_city"] . ', ' . $contact["company_state"] . " " . $contact["company_zip"] . '</p>';

                    echo '<p>' . $contact["primary_contact"] . '<br />';
                    echo  $contact["primary_contact_phone"] . '<br />';
                    echo  $contact["primary_contact_email"] . '</p>';

                     echo '<p>' . $contact["secondary_contact"] . '<br />';
                    echo $contact["secondary_contact_phone"] . '<br />';
                    echo  $contact["secondary_contact_email"] . '</p>';
                  
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'No contacts found';
            }
            ?>      

        <script type="text/javascript" src="on_load.js"></script>

    </body>

</html>