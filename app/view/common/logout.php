<?php

session_start();

//echo 'Username: '.$_SESSION['username'];
//echo '<br> User group: '.$_SESSION['usergroup'];

//session_unset($_SESSION['username']);
//session_unset($_SESSION['usergroup']);
session_destroy();
header("Location: login.php");