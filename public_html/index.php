<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>And The Doors</title>

        <link rel="stylesheet" type="text/css" href="main.css" />
    </head>
    <body>

        <header>
            <div id="date_header">Today is 
                <?php
                date_default_timezone_set('America/New_York');
                echo date("l, F d, Y");
                ?>
            </div>
        </header>

        <!-- Search bar -->
        <div id="find"> 
            <input id="search_input" type="text" placeholder="Search"/>
            <div id="search_icon"></div>
            <?php include_once("php/find.php"); ?>
        </div>

        <!-- Left hand navigation -->
        <div id="nav">
            <ul>
                 <li><a href="#" id="link_index">Home</a></li>
                <li><a href="#" id="link_contacts">Contacts</a></li>
                <li><a href="#" id="link_projects">Projects</a></li>
                <li><a href="#" id="link_invoices">Quotes/Invoices</a></li>
                <li><a href="#" id="link_email">Email</a></li>
            </ul>
        </div>

        <div id="content">
            Welcome! Please make a selection from the left hand side navigation.
        </div>

        <script src="js/jquery-2.1.3.js" type="text/javascript"></script>
        <script type="text/javascript" src="on_load.js"></script>

    </body>


</html>

