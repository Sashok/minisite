<?php error_reporting(E_ALL ^ E_NOTICE); 
@session_start();
//     
$LangArray = array("ru", "ua", "en");
//   
$DefaultLang = "ua";

//           
if(@$_SESSION['NowLang']) {
	//       
	if(!in_array($_SESSION['NowLang'], $LangArray)) {
		//  ,    
		$_SESSION['NowLang'] = $DefaultLang;
	}
}
 else {
 	$_SESSION['NowLang'] = $DefaultLang;
 }

//      GET
$language = addslashes($_GET['lang']);
if($language) {
	//       
	if(!in_array($language, $LangArray)) {
		//  ,    
		$_SESSION['NowLang'] = $DefaultLang;
	}
	 else {
	 	//    
	 	$_SESSION['NowLang'] = $language;
	 }
}

//   
$CurentLang = addslashes($_SESSION['NowLang']);
include_once ("lang/lang.".$CurentLang.".php");

  if($submit){
      if ($login==$_POST['login']&& $password==$_POST['password']){
      $logged_user = $login;
      session_register("logged_user");
        }
  }
if(isset($_POST['login'])) {$login = $_POST['login']; if ($login == '') {unset($login);} }
if(isset($_POST['password'])) {$password = $_POST['password']; if ($password == '') {unset($password);} }
if(isset($_POST['date_log'])) {$date_log = $_POST['date_log']; if ($date_log == '') {unset($date_log);} }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title><? echo "$Lang[Entrance]"?></title>

<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="700" border="0" align="center" bgcolor="#FFFFFF" class="main_border" cellspacing="0" cellpading="0">
 <? include("blocks/header.php");?>
  <tr>
    <td valign="top"><table width="100%" border="0">
      <tr>
        
        <td valign="top" class="news">
       <? if (empty($login)) 
    {
    exit ("<p>$Lang[Come_back_and_fill_both_fields_login_and_password] <br> <a href='index.php'>$Lang[Back]</a></p>");
    }
	if(empty($password))
	{
    exit ("<p>$Lang[Come_back_and_also_fill_the_field_password] <br> <a href='index.php'>$Lang[Back]</a></p>");
    }
    //    ,  ,      ,      
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
	$date_log = stripslashes($date_log);
    $date_log = htmlspecialchars($date_log);
//  
    $login = trim($login);
    $password = trim($password);

    include ("blocks/bd.php"); 
 
$result = mysql_query("SELECT id, login, password FROM anketa WHERE login='$login'",$db); //         
    $myrow = mysql_fetch_array($result);
    if (empty($myrow['password']))
    {
    	exit ("<p>$Lang[Entered_by_you_login_or_a_password_is_incorrect]</br> <a href='index.php'>$Lang[Back]</a></p>");
    }
    else {
    // ,   
	
    if ($myrow['password']==$password)
	 {
    //  ,    !   ,  !
    $_SESSION['login']=$myrow['login']; 
    $_SESSION['password']=$myrow['password'];
	$_SESSION['user_id']=$myrow['id'];
	 
	 
    echo "$Lang[You_successfully_entered_on_a_website_Pass_to_the_main_page] <br></br> <a href='index_gol.php'>$Lang[Main_page]</a>";
  	$date_log=date("j:m:Y");
	
	mysql_query("UPDATE  anketa SET date_log = '$date_log'  WHERE login='$login' ");
			
	 }
	
 else 
 {
    exit ("<p>$Lang[I_am_sorry_entered_by_you_login_or_a_password_is_incorrect] </br> <a href='index.php'>$Lang[Back]</a></p>");
    }
    }
    ?>
	</td>
      </tr>
    </table></td>
  </tr>
 <? include("blocks/footer.php");?>
</table>
</body>
</html>