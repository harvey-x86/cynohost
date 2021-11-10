<html lang="en">

    <head>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        
        <link rel="stylesheet" type="text/css" href="/cynohost/stylesheets/theme.css">
        <link rel="icon" type="image/png" href="/cynohost/media/favicon.png">

        <title>Cynohost | File Hosting</title>
        

    </head>

    <body>

        <div id="header">

            <div class="social-media">

                <img src="/cynohost/media/github.png">
                <img src="/cynohost/media/twitter.png">
                <img src="/cynohost/media/facebook.png">

            </div>

            <div class="group">

                <button>About</button>
                <button>FAQ</button>
                <button>Premium</button>

            </div>

        </div>

        <div id="container">

            <img src="/cynohost/media/cynohost-logo.png" class="logo" draggable="false"/>
            <br>
            <b>File-Hosting Freedom.</b>
            <br>
            <span>CynoHost means <b id="word">Security</b></span>
            <br>
            <button class="upload">Upload A File</button>
            <br>
            <form method="post" enctype="multipart/form-data" id="uploadFile" class="hide" action="index.php">
                <input type="file" name="uploaded-file"/>
                <input type="submit" value="Upload &#10548;"/>
            </form>
            
            <?php
            
                if($_SERVER['REQUEST_METHOD'] == "POST") {

                    $chars = "ABCDEFGHIJKLMMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
                    $shfl = str_shuffle($chars);
                    $final = substr($shfl, 55);
                    mkdir($final);
                    
                    $finalpath = $final . '/' . $_FILES['uploaded-file']['name'];
                    
                    $s = scandir("heads");
                    
                    for($i=0; $i<8; $i++) {
                        
                        if($s[$i] == $_FILES['uploaded-file']['name']) {
                            unlink($s[$i]);
                            move_uploaded_file($_FILES['uploaded-file']['tmp_name'], $finalpath);
                        }
                        
                        else {
                            move_uploaded_file($_FILES['uploaded-file']['tmp_name'], $finalpath);
                        }
                        
                    }
                    
                    if(!$_FILES['uploaded-file']['name']) {
                        echo '<script>document.querySelector("#container").insertAdjacentHTML("beforeend", "<er>Unable to upload file! Please try again</er>");</script>';
                    }
                        
                    else {
                        header("Location: http://harveycoombs.com/cynohost".$finalpath);
                    }
        
                }
            
            ?>

        </div>

        <div id="footer"><span>Written in PHP & JS by <a href="/">Harvey</a> &#183; 2021</span></div>
        
        <script src="/cynohost/scripts/main.js" type="text/javascript"></script>

    </body>

</html>