<?php
function getConnectionMSSQLv1(){
      ///$serverName = "192.168.16.10";
      $serverName = "localhost";
      $serverPort = "5432";
      $serverDb   = "dominios";
      $serverUser = "postgres";
      $serverPass = "7SME$6:T5{NIv5g:";
      
      try {
          $conn = new PDO(
              "pgsql:dbname=$serverDb;host=$serverName;port=$serverPort",
              $serverUser,
              $serverPass,
              array(
                  PDO::ATTR_PERSISTENT => false,
                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              )
          );
         
  
          if ($conn) {
              header('Content-Type: text/html; charset=utf-8');
              return $conn;
          }
      } catch (PDOException $e) {
          header("Content-Type: application/json; charset=utf-8");
          echo json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error Connecting to MSSQL: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
          die();
      }
}

function getConnectionMSSQLv2(){
        ///$serverName = "192.168.16.10";
    $serverName = "localhost";
    $serverPort = "5432";
    $serverDb   = "dominios";
    $serverUser = "postgres";
    $serverPass = "7SME$6:T5{NIv5g:";
    
    try {
        $conn = new PDO(
            "pgsql:dbname=$serverDb;host=$serverName;port=$serverPort",
            $serverUser,
            $serverPass,
            array(
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            )
        );
       

        if ($conn) {
            header('Content-Type: text/html; charset=utf-8');
            return $conn;
        }
    } catch (PDOException $e) {
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error Connecting to MSSQL: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        die();
    }
}
?>
