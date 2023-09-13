<?php require_once('../Connections/HADAMI.php');
require("class.phpmailer.php");
?>
<?php
if(isset($_POST['Tipo']))
{
	if($_POST['Tipo']=="usuario"){
		mysql_select_db($database_HADAMI, $HADAMI);
		$query_usuario = "SELECT * FROM registro where USER='".$_POST['USER']."'";
		$usuario = mysql_query($query_usuario, $HADAMI) or die(mysql_error());
		$row_usuario = mysql_fetch_assoc($usuario);
		$totalRows_usuario = mysql_num_rows($usuario);
		if($totalRows_usuario<=0)
		{
			echo "Username available";
			echo "<input type=\"hidden\" name=\"band\" id=\"band\" value=\"0\" />";
		}
		else
		{
			echo "Username not available";
			echo "<input type=\"hidden\" name=\"band\" id=\"band\" value=\"1\" />";
		}
	}
	if($_POST['Tipo']=="email"){
		mysql_select_db($database_HADAMI, $HADAMI);
		$query_emai = "SELECT * FROM registro where EMAI='".$_POST['EMAI']."'";
		$emai = mysql_query($query_emai, $HADAMI) or die(mysql_error());
		$row_usuario = mysql_fetch_assoc($emai);
		$totalRows_emai = mysql_num_rows($emai);
		if($totalRows_emai<=0)
		{
			echo "";
			echo "<input type=\"hidden\" name=\"band2\" id=\"band2\" value=\"0\" />";
		}
		else
		{
			echo "the mail is already registered";
			echo "<input type=\"hidden\" name=\"band2\" id=\"band2\" value=\"1\" />";
		}
	}
	if($_POST['Tipo']=="email2"){
		mysql_select_db($database_HADAMI, $HADAMI);
		$query_emai = "SELECT * FROM registro where EMAI='".$_POST['EMAI']."'";
		$emai = mysql_query($query_emai, $HADAMI) or die(mysql_error());
		$row_usuario = mysql_fetch_assoc($emai);
		$totalRows_emai = mysql_num_rows($emai);
		if($totalRows_emai<=0)
		{
			echo "the mail is not already registered";
			echo "<input type=\"hidden\" name=\"band2\" id=\"band2\" value=\"1\" />";
		}
		else
		{
			echo "";
			echo "<input type=\"hidden\" name=\"band2\" id=\"band2\" value=\"0\" />";
		}
	}
	if($_POST['Tipo']=="reme"){
		mysql_select_db($database_HADAMI, $HADAMI);
		$query_emai = "SELECT * FROM registro where EMAI='".$_POST['EMAI']."'";
		$emai = mysql_query($query_emai, $HADAMI) or die(mysql_error());
		$row_usuario = mysql_fetch_assoc($emai);
		$totalRows_emai = mysql_num_rows($emai);
		if($totalRows_emai<=0)
		{
			echo "";
			echo "<input type=\"hidden\" name=\"band2\" id=\"band2\" value=\"0\" />";
		}
		else
		{
///-----------------------------------------------------------------***
///  				MAIL DE CONFIRMACION CON PHP MAILER				***
///-----------------------------------------------------------------***
$mail = new PHPMailer(); 
$mail->IsSMTP(); 
$mail->SMTPAuth = FALSE; // True para que verifique autentificación de la cuenta o de lo contrario False 
$mail->Username = "dominio@dominio.com"; // Tu cuenta de e-mail 
$mail->Password = "*******"; // El Password de tu casilla de correos


$mail->Host = "localhost"; 
$mail->From = "contact@cosme.com.au"; 
$mail->FromName = "Contact"; 
$mail->Subject = "Account Details"; 
$mail->AddAddress($row_usuario['EMAI'],$row_usuario['NOMB']); 

////-------------------------------------------------///
	$body = "Password\n"; 
///--------------------------------------------------///

$mail->WordWrap = 50; 

$body = "Cosme Australia Account Details \n"; 
$body .= "User: " .$row_usuario['USER']. "\n"; 
$body .= "Password: " .$row_usuario['PASS']. "\n";
$body .= "Email: " .$row_usuario['EMAI']. "\n"; 
 
$mail->Body = $body; 

$mail->Send(); 

// Notificamos al usuario del estado del mensaje 

///-----------------------------------------------------------------***
///  			FIN	MAIL DE CONFIRMACION CON PHP MAILER				***
///-----------------------------------------------------------------***
echo "In berve receive in email with your account details"; 		
	
		}
	}
}

?>
