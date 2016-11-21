<?php


$errors = [];


if(!array_key_exists('name', $_POST) || $_POST['name'] == '') {
  $errors['name'] = "Vous n'avez pas renseigné votre nom";
}
if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  $errors['email'] = "Vous n'avez pas renseigné un Email valide";
}
if(!array_key_exists('objet', $_POST) || $_POST['objet'] == '') {
  $errors['objet'] = "Vous n'avez pas renseigné l'objet de votre message";
}
if(!array_key_exists('message', $_POST) || $_POST['message'] == '') {
  $errors['message'] = "Vous n'avez pas renseigné votre message";
}

  session_start();

if(!empty($errors)){

  $_SESSION['errors'] = $errors;
  $_SESSION['input'] = $_POST;
  header('Location: contact-form.php#form');
}else{
  $nom     = ($_POST['name']);
  $mail    = ($_POST['email']);
  $objet   = ($_POST['objet']);
  $message = ($_POST['message']);
  $message_to_send = "Nom : $nom <br><br>
              Mail : $mail <br><br>
              Message : $message";
  // $headers = 'FROM: site germain';
  // $to      = 'germain.jam@gmail.com';


  echo $message_to_send;
  // $_SESSION['sucess'] = 1;

  // mail($to, $objet, $message, $headers);
  // header('Location: contact-form.php#contactform');

}



