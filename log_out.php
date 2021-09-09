<?php 

    session_start();
    $_SESSION['email'] = '';
    $_SESSION['password'] = '';
    session_destroy();
    header("Location: sign_in.php");

?>

<!DOCTYPE html>
<html lang="en">

<h3>Log Out Successfull</h3>
<a href = 'sign_in.php'>Click Here to redirect to Signin Page</a>
<br>
<br>

<a href = 'sign_up.php'>Click Here to redirect to Signup Page</a>
</html>