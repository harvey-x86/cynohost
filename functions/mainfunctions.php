<?php

    //2021 - HARVEY COOMBS

    function checkBanStatus() {
        $ip = $_SERVER["REMOTE_ADDR"];

        $connection = new mysqli("92.204.220.200", "AdminHarvey", "c9Ry53#]8&$%\$a", "cynohost");
        $q = $connection -> query("SELECT * FROM banlist WHERE ip_address=\"".$ip."\"");
        $banned = mysqli_num_rows($q) > 0;

        if ($banned) {
            header("Location: http://cynohost.com/banned.php");
        }
    }

    function searchHelpCenter() {
        $search_query = $_GET["q"];

        $connection = new mysqli("", "", "", ""); 
        $q = $connection -> query("SELECT title, content, url FROM help_articles WHERE title LIKE '%".$search_query."%'");

        $result = $q -> fetch_assoc();
        $out = "";
        print($out); 
    }

?>
