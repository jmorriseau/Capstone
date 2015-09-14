<!DOCTYPE html>
<!--This page is the main page for the contacts functionality-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/contacts/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
    </head>
    <body>

        <div id="contact_header">
            <h2>Please select a contact below to begin.</h2>
        </div>

        <!--Link to add_contact.php-->
        <div class="contact_content">
            <div id="link_add_contact">
                <a href="#">
                    <div class="contact_name">Add Contact</div>
                    <div class="contact_body"><div class="icon"><i class="fa fa-plus fa-5x"></i></div></div>
                </a>
            </div>
        </div>

        <!--Pull in existing contacts to display for the user-->
        <div class="contact_content">
            <?php
            $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
            $dbs = $pdo->prepare('select * from contact_table');
            $contacts = array();

            if ($dbs->execute() && $dbs->rowCount() > 0) {
                $contacts = $dbs->fetchAll(PDO::FETCH_ASSOC);

                foreach ($contacts as $contact) {
                    echo '<table><thead>';
                    echo '<tr><th>' . 'Contact Information' . '</th></tr></thead>';

                    echo '<tbody><tr> <td>' . $contact["company_name"] . '</td> </tr>';
                    echo '<tr> <td>' . $contact["company_address_line_one"] . '</td></tr>';
                    echo '<tr> <td>' . $contact["company_address_line_two"] . '</td></tr>';
                    echo '<tr> <td>' . $contact["company_city"] . ',' . '</td><td>' . $contact["company_state"] . '</td><td>' . $contact["company_zip"] . '</td></tr>';

                    echo '<tr> <td>' . $contact["primary_contact"] . '</td></tr>';
                    echo '<tr> <td>' . $contact["primary_contact_phone"] . '</td></tr>';
                    echo '<tr> <td>' . $contact["primary_contact_email"] . '</td></tr>';

                    echo '<tr> <td>' . $contact["secondary_contact"] . '</td></tr>';
                    echo '<tr> <td>' . $contact["secondary_contact_phone"] . '</td></tr>';
                    echo '<tr> <td>' . $contact["secondary_contact_email"] . '</td></tr></tbody>';

                    echo '</table>';
                }
            } else {
                echo 'No contacts found';
            }
            ?>
        </div>

        <!--This is example only - To be removed -->
        <div class="contact_content">		
            <div id="link_add_contact"></div>
            <div class="contact_name">Some Other Contact</div>
            <div class="contact_body">
                <p>Sam Smith<br />
                    123 Main St<br />
                    Suite 200<br />
                    Providence, RI 02903</p>
                <p>508.963.5625<br />
                    555.258.2546</p>
                <p>bob@name.com</p>
            </div>
        </div>

        <script type="text/javascript" src="on_load.js"></script>

    </body>

</html>