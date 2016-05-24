<?php
    session_start();

    $td_idents = timezone_identifiers_list();

    $_SESSION['user_tz_ident'] = 'America/New_York';

    if(isset($_POST['submit'])){
        // save the TZ choice
        $tz_choice = $_POST['tz_choice'];
        // Only accept value if it is in the list
        if(in_array($tz_choice, $td_idents)) {
            $_SESSION['user_tz_ident'] = $tz_choice;
            $user_tz_ident = $tz_choice;
        }
        //echo $user_tz_ident;
    }else{
        //check for previous TZ settings
        $user_tz_ident = $_SESSION['user_tz_ident'];
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Time Zone Selection</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="main-content">

      <h1>Time Zone Selection</h1>


        <a href="../timezone_sensitivity/index.php"; >"Current time"</a>
        <br />
        <br />

      <form action="" method="post">
        
        Preferred Time Zone:
        <select name="tz_choice">

            <?php
                $dt = new DateTime('now');

                foreach($td_idents as $zone){
                    $dt->setTimezone(new DateTimeZone($zone));

                    $offset = $dt->format('P');

                    echo "<option value=\"{$zone}\"";
                    if ($user_tz_ident == $zone){
                        echo " selected";
                    }
                    echo ">";
                    echo $zone." (UTC/GMT {$offset})";
                    echo "</option>";
                }
            ?>

        </select>

        <br />
        <div class="controls">
          <input type="submit" name="submit" value="Submit" />
        </div>
      </form>
  
    </div>



  </body>
</html>