<?php

SESSION_start();

if(isset($_POST['x'])){
  $empp = $_SESSION['id'];
  echo $empp;
}


 ?>
