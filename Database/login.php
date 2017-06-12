<?php
include('connection.php');

function strip_special_characters($str)
  {
    $out = "";
    for ($i = 0;$i < strlen($str);$i++)
      if ((ord($str[$i]) != 9) && (ord($str[$i]) != 10) &&
          (ord($str[$i]) != 13))
        $out .= $str[$i];

    // Return pre-parsed SQL statement.
    return $out;
  }


If (isset($_POST['username']) && isset($_POST['password']))
{
    //be sure to validate and clean your variables
    $val1 = $_POST['username'];
    $val2 = $_POST['password'];

    $stid = oci_parse($connection, strip_special_characters("begin :r := usershandler.loginR(:u,:p); end;"));
    oci_bind_by_name($stid, ':r', $r, 40);
    oci_bind_by_name($stid, ':u', $val1);
    oci_bind_by_name($stid, ':p', $val2);

    oci_execute($stid);

    if($r > 0)
      echo '<br>Login succeded!';
    else
      echo '<br>Login failed!';

    oci_free_statement($stid);

}
oci_close($connection);
?>

<html>
<body>

<form action="" method="post">
  Username:<br>
  <input type="text" name="username" value="">
  <br>
  Password:<br>
  <input type="password" name="password" value="">
  <br><br>
  <input type="submit" value="Login">
</form>

</body>
</html>
