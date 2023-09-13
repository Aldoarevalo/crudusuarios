<?php require_once('../Connections/HADAMI.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_HADAMI, $HADAMI);
$query_confirmar = "SELECT * FROM registro where USER='".$_GET['user']."' and EMAI='".$_GET['EMAIL']."' and ESTA_REGI='0'";
$confirmar = mysql_query($query_confirmar, $HADAMI) or die(mysql_error());
$row_confirmar = mysql_fetch_assoc($confirmar);
$totalRows_confirmar = mysql_num_rows($confirmar);
if($totalRows_confirmar >0){
   $update_confirmar = "update registro set ESTA_REGI='1' where IDEN_REGI=".$row_confirmar['IDEN_REGI'];
   $update = mysql_query($update_confirmar, $HADAMI) or die(mysql_error());
   header("Location: ../index.php");
}
else{
	echo  "The mail has now been confirmed";
}
?>
