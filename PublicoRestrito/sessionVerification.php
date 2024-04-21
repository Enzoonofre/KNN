<?php

function exitWhenNotLoggedIn()
{ 
  if (!isset($_SESSION['loggedIn'])) {
    header("Location: ../PublicoGeral/Login/login.html");
    exit();  
  }
}
