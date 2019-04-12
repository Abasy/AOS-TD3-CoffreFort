<?php
  // Démarrage ou restauration de la session
  session_start();
?>

<div>
  <?php
      //Pas de champs vide dans les input
      $myRegister = array(
        'token' => $_COOKIE['token_coffre_fort']
      );
    
      $myJSON = json_encode($myRegister);

      $crl = curl_init("http://localhost:4321/api/logout");
      curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($crl, CURLINFO_HEADER_OUT, true);
      curl_setopt($crl, CURLOPT_POST, true);
      curl_setopt($crl, CURLOPT_POSTFIELDS, $myJSON);
      curl_setopt($crl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Body:'.$myJSON,
        'Content-Lenght:'.strlen($myJSON))
      );
      $result = curl_exec($crl);
      curl_close($crl);

      //Destruction du cookie
      setcookie('token_coffre_fort','',time()-3600);
      // Réinitialisation du tableau de session
      // On le vide intégralement
      $_SESSION = array();
      // Destruction de la session
      session_destroy();
      // Destruction du tableau de session
      unset($_SESSION);

      echo '<script>
                  window.location.href = "../PageWeb/index.php"
                </script>';
  ?>
</div>
