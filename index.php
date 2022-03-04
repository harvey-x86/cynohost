<!-- 2021 WRITTEN BY HARVEY COOMBS | HARVEYCOOMBS.COM -->
<?php 
    session_start();
    
    $premium = "<a class=\"option\" href=\"/premium\">premium</a><a class=\"option\" href=\"/login\">login</a>";
    
    $connection = new mysqli("", "", "", ""); 

    $auth = $_SESSION["login"];

    function getUserInfo($db) {
        $q = $db -> query("SELECT * FROM premium_users WHERE session_id=\"".$_SESSION["login"]."\"");
        $final = $q -> fetch_assoc();
        return $final;
    }
    
    if (strlen($auth) > 0) {
        $login = getUserInfo($connection);
        $premium = (strlen($auth) > 0) ? "<a class=\"option\" onclick=\"logout()\">logout</a><a href=\"/account\"><img src=\"/premium/user-avatars/".$login["avatar"]."\" class=\"avatar\"/></a>" : $premium; 
    }
?>
<html lang="en">

	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="CynoHost, File-Hosting Freedom" />
		<meta charset="utf-8" />
		
		<meta property="og:title" content="CynoHost" />
		<meta property="og:description" content="File-hosting freedom | Free 1GB uploads" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://cynohost.com/" />
		<meta property="og:image" content="http://cynohost.com/cyno-splash.png" />
		<meta property="theme-color" content="#23CE6B" />

		<link rel="stylesheet" type="text/css" href="stylesheets/theme.css" />
		<link rel="stylesheet" type="text/css" href="stylesheets/home.css" />
		<link rel="icon" type="image/png" href="media/favicon.png" />

		<title>CynoHost | File-Hosting Freedom</title>

	</head>

	<body>
	    
	    <header>

	        <a href="/"><img src="media/icon.png" alt="icon" /></a>
	        <div><?php echo $premium; ?></div>
	        
	    </header>

		<section>
		    
			<div id="upload" class="box">
			    
			    <img src="media/logo.png" alt="cynohost logo" />
			    <strong>1GB Max file-size. <a href="premium">Need more?</a></strong>
                <button class="button-main" id="upload_button">Upload A File</button>
    			<a class="help-link" href="mailto:support@cynohost.com">Something's Wrong</a>
			
			</div>
			
			<div id="text">
			    <strong>CynoHost Means <target>Reliability</target></strong>
			    <span>Share your files with confidence &#128165;</span>
			</div>

		</section>
		
		<section>
		    
        <div class="box-alt promo-enq">
            <strong>Looking to advertise on <span>CynoHost</span>?</strong>
            <p>We offer low-price & high-exposure ad-space <b>here</b> across CynoHost. Use the button below to enquire further:</p>
            <a class="button-main" href="mailto:enquiries@cynohost.com">Get In Touch</a>
        </div>
		    
		</section>
		
    		<div id="uploader" class="popup-outer hide">
            <div class="popup">
                <div class="top">
                    <strong>Upload Files</strong>
                    <button>&times;</button>
                </div>
                <div class="data dashed-border">
                    <div class="inner-upl"><strong>Your Files Will Appear Here</strong><span>Drop your files here or click this area to upload</span></div>
                </div>
                <div class="main">
        			<form action="index.php" enctype="multipart/form-data" method="post">
                        <input type="file" style="display: none;" name="uploaded-file[]" multiple/>
                        <div class="upload-settings">
                    		<div class="use-password">
                    			<input type="checkbox" name="protected" id="pw_toggle" />
                    			<strong>Protect With Password</strong>
                    		</div>
                    		<select class="expire-selector">
                    		    <option data-exp="12">12 Hours</option>
                    		    <option data-exp="24">24 Hours</option>
                		    </select>
                		</div>
                		<div class="upload_options">
                    		<input type="button" id="clear_upload" name="clear" class="button-alt" value="Clear" />
                    		<input type="submit" class="button-main" id="submit_files" name="upload" />
                		</div>
                		<?php

                            if($_SERVER['REQUEST_METHOD'] == "POST") {
                                
                                $fc = count($_FILES['uploaded-file']['name']);
                                
                                if ($_POST["upload"]) {
                                    
                                    if ($fc > 0) {
                                        $chars = "ABCDEFGHIJKLMMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
                                        $shfl = str_shuffle($chars);
                                        $final = substr($shfl, 55);
                                        
                                        $total_size = 0;
                                        
                                        mkdir($final);
                                        
                                        for ($i=0; $i<$fc; $i++) {
                                            $finalpath = $final . '/upload-' . $_FILES['uploaded-file']['name'][$i];
                                            move_uploaded_file($_FILES['uploaded-file']['tmp_name'][$i], $finalpath);
                                            $total_size .= $_FILES['uploaded-file']['size'][$i];
                                        }
                                        
                                        $file_pw = sha1($_POST["pw"]);
    									$q = ($_POST["protected"]) ? "INSERT INTO files (name, password, size, count, ip) VALUES (\"".$final."\", \"".$file_pw."\", \"".$total_size."\", \"".$fc."\", \"".$_SERVER["REMOTE_ADDR"]."\")" : "INSERT INTO files (name, size, count, ip) VALUES (\"".$final."\", \"".$total_size."\", \"".$fc."\", \"".$_SERVER["REMOTE_ADDR"]."\")";
                                        $query = $connection -> query($q);
    									
                                        $s = "templ/index.php";
                                        $d = $final."/index.php";
                                        copy($s, $d);
                                        
                                        header("Location: http://cynohost.com/".$final);
                                        $connection -> close();
                                    }
                                    
                                }
                                
                            }
                        ?>
            		</form>
                </div>
            </div>
        </div>
    
		<footer id="footer">
		    <span>Designed & Developed By <a href="http://twitter.com/harveyc2003">Harvey C.</a> &#183; </span>
		    <div class="lang-selector">
		        <img src="/media/en.png" id="lang-flag" />
    		    <select id="langSelect">
    		        <option data-lang="en" selected>EN</option>
    		        <option data-lang="nl">NL</option>
    		        <option data-lang="fr">FR</option>
    		        <option data-lang="de">DE</option>
    		    </select>
		    </div>
		</footer>
		
		<script type="text/javascript" defer src="scripts/main.js"></script>
		<script type="text/javascript" defer src="scripts/home.js"></script>

	</body>

</html>