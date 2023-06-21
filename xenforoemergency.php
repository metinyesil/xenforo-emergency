<?php

if(isset($_POST["submit"]))
{
    $password = $_POST["password"];
    $baglanti = new PDO("mysql:host=localhost;dbname=dbname", "dbuser", "dbpassword");
    $baglanti->exec("SET NAMES utf8");
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "
    UPDATE xf_user_authenticate
    SET data = BINARY
        CONCAT(
            CONCAT(
                CONCAT('a:3:{s:4:\"hash\";s:40:\"', SHA1(CONCAT(SHA1('".$password."'), SHA1('salt')))),
                CONCAT('\";s:4:\"salt\";s:40:\"', SHA1('salt'))
            ),
            '\";s:8:\"hashFunc\";s:4:\"sha1\";}'
        ),
    scheme_class = 'XenForo_Authentication_Core'
    WHERE user_id = 1;
";
}

?>
<body style="background: #006296;">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 
    $sonuc = $baglanti->exec($sql);

    if ($sonuc > 0) {
        echo "
        <script>
    Swal.fire({
        icon: 'success',
        title: 'Successful!',
        text: 'Password changed successfully',
        confirmButtonText: 'Ok'
    });
</script>
        ";
    } else {
        echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'An error occurred while changing the password',
        confirmButtonText: 'Ok'
    });
</script>";
    }
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<div class="card text-center" style="border:0;">
  <div class="card-header" style="background: #006296;margin-top: -1;">
    <img width="150" src="https://upload.wikimedia.org/wikipedia/en/e/e5/XenForo%C2%AE_logo_on_blue_square_background.png"><br>
  </div>
  <div class="card-body" style="    background: #00314c;">
    <form method="POST"><br>
    <input type="text" style="    padding: 6px;
    border-radius: 5px;
    border: 0;
    height: 40px;
    width: 252px;
    padding-left: 12px;" placeholder="Please enter your new password." name="password">
    <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
    </form>
  </div>
  <div class="card-footer text-body-secondary" style="text-align:left;">
    Usage:
    <ul>
    <li>Enter your new password in the field above and press the save button.</li>
    <li>XFEmergency will only change the password of the user with 1 ID, so be careful.</li>
    <li>Delete the file when you're done. No responsibility is accepted for the risks arising from its deletion.</li>
    </ul>
<a href="https://github.com/metinyesil">https://github.com/metinyesil</a>
  </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
