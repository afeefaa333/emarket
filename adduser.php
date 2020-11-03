<?php
  require('connection.php');
  if (isset($_POST['reg_user'])){
    $user = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password_1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password_2']);
    if ($password!=$password2){
      echo "Not confirmed";
      header('Location: registration.php');
    }
    $results = mysqli_query($db, "SELECT count(*) FROM users WHERE username='".$user."'");
    if ($results)
    {
     echo "Username already exists";
     header('Location: index.php');
    }
    // attempt insert query execution
    if($password = $password2){
      $sql = "INSERT INTO users VALUES (username='$user', password='$password')";
      if(mysqli_query($db, $sql)){
      echo "User added successfully.";
      header('Location: index.php');
      }
    } 
    else{
      echo "Could not add the user.";
      header('Location: index.php');
    }
    mysqli_close($db);
  }
?>