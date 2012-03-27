<? error_reporting(E_ALL ^ E_NOTICE); 
@session_start();
// Массив доступных для выбора языков
$LangArray = array("ru", "ua", "en");
// Язык по умолчанию
$DefaultLang = "ua";

// Если язык уже выбран и сохранен в сессии отправляем его скрипту
if(@$_SESSION['NowLang']) {
	// Проверяем если выбранный язык доступен для выбора
	if(!in_array($_SESSION['NowLang'], $LangArray)) {
		// Неправильный выбор, возвращаем язык по умолчанию
		$_SESSION['NowLang'] = $DefaultLang;
	}
}
 else {
 	$_SESSION['NowLang'] = $DefaultLang;
 }

// Выбранный язык отправлен скрипту через GET
$language = addslashes($_GET['lang']);
if($language) {
	// Проверяем если выбранный язык доступен для выбора
	if(!in_array($language, $LangArray)) {
		// Неправильный выбор, возвращаем язык по умолчанию
		$_SESSION['NowLang'] = $DefaultLang;
	}
	 else {
	 	// Сохраняем язык в сессии
	 	$_SESSION['NowLang'] = $language;
	 }
}

// Открываем текущий язык
$CurentLang = addslashes($_SESSION['NowLang']);
include_once ("lang/lang.".$CurentLang.".php");

  if(!isset($logged_user)){
    header("Location: index.php");
    exit;
  }
  include("blocks/bd.php");
if(isset($_POST['name'])) {$name = $_POST['name']; if ($name == '') {unset($name);} }
if(isset($_POST['surname'])) {$surname = $_POST['surname']; if ($surname == '') {unset($surname);} }
if(isset($_POST['login'])) {$login = $_POST['login']; if ($login == '') {unset($login);} }
if(isset($_POST['password'])) {$password = $_POST['password']; if ($password == '') {unset($password);} }
if(isset($_POST['passwordd'])) {$passwordd = $_POST['passwordd']; if ($passwordd == '') {unset($passwordd);} }
if(isset($_POST['email'])) {$email = $_POST['email']; if ($email == '') {unset($email);} }
if(isset($_POST['load'])) {$load = $_POST['load']; if ($load == '') {unset($load);} }
if(isset($_POST['date_reg'])) {$date_reg = $_POST['date_reg']; if ($date_reg == '') {unset($date_reg);} }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title><? echo $Lang['Registration']?></title>

<link href="style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<table width="700" border="0" align="center" bgcolor="#FFFFFF" class="main_border" cellspacing="0" cellpading="0">
 <? include("blocks/header.php");?>
  <tr>
    <td valign="top"><table width="100%" border="0">
      <tr>
             <td valign="top" class="news">
        <? if (empty($name) or empty($surname) or empty($login) or empty($password) or empty($passwordd) or empty($email)) 
    {
    exit ("$Lang[You_entered_not_all_information_come_back_and_fill_all_fields]<br> <a href='http://localhost/minisite/form.php'>$Lang[Back]</a>");
    }
    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $surname = stripslashes($surname);
    $surname = htmlspecialchars($surname);
	$login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
	$passwordd = stripslashes($passwordd);
    $passwordd = htmlspecialchars($passwordd);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
	$date_reg = stripslashes($date_reg);
    $date_reg = htmlspecialchars($date_reg);
	
	 $name = trim($name);
     $surname = trim($surname);
	 $login = trim($login);
     $password = trim($password);
	 $passwordd = trim($passwordd);
 	 $email = trim($email);
 	 $date_reg = trim($date_reg);

	
	if ($password != $passwordd) {
		exit ("Не вірне підтвердження паролю!");
	}
	$result = mysql_query("SELECT id FROM anketa WHERE login='$login' ",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id']))
	{
    exit ("$Lang[I_am_sorry_entered_by_you_a_login_is_already_registered_Enter_the_second_login]<br><a href='form.php'>$Lang[Page_of_registration]</a>");
    }
	
	$result = mysql_query("SELECT id FROM anketa WHERE email='$email'",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id']))
	{
    exit ("$Lang[Such_e_mail_is]<br><a href='form.php'>$Lang[Page_of_registration]</a>");
    }	
	 
    { 
	$date_reg=date("j:m:Y");
	  $result2 = mysql_query("INSERT INTO anketa (name,surname,login,password,email,date_reg) VALUES('$name', '$surname', '$login', '$password', '$email','$date_reg')");
	  } 
	    if ($result2=='TRUE')
        {
    echo "$Lang[You_were_successfully_registered_as] <strong>$surname $name</strong>! $Lang[Now_you_can_call_on_a_website] <a href='index_gol.php'>$Lang[Main_page]</a>";
   
	}
 else {
    echo "$Lang[Error_you_are_not_registered]";
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