<? error_reporting(E_ALL ^ E_NOTICE); 
session_start();
//     
$LangArray = array("ru", "ua", "en");
//   
$DefaultLang = "ua";

//           
if($_SESSION['NowLang']) {
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

 include("blocks/bd.php");
if (isset($_POST['login'])) {$login = $_POST['login'];}
if (isset($_POST['password'])) {$login = $_POST['password'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title>¬ход</title>

<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table class="main_border">
 <? include("blocks/header.php");?>
  <tr class="body">
    <td class="td1"> <table width="100%" border="0">
      <tr>
        <td class='left'>
    <a href="index.php?lang=en"><img src="img/en.png" /></a> 
	<a href="index.php?lang=ua"><img src="img/ua.png" /></a> 
	<a href="index.php?lang=ru"><img src="img/ru.png" /></a>
       <form action="index_vhod.php" method="post" name="form1">
<p><label><? echo($Lang['Your_login']);?><input name="login" type="text" size="20" maxlength="10"/></label></p>
<p><label><? echo($Lang['Your_password']);?> <input name="password" type="password" size="20" maxlength="10"/></label></p>
<input name="date_log" type="hidden" value="log">
<p><input name="submit" type="submit" value="<? echo($Lang['Entrance']);?>"/></p>
</form>
<form action="form.php" method="post" name="form2">
<p><input name="submit" type="submit" value="<? echo($Lang['Registration']);?>"/></p>
</form>
        </td>
        <td valign="top" class="news">
<p><? echo($Lang['For_an_entrance_on_a_website_enter_a_login_and_password']);?> <br></br><? echo($Lang['If_you_are_not_registered_then_register_oneself']);?></p>
</td>
      </tr>
    </table></td>
  </tr>
 <? include("blocks/footer.php");?>
</table>
</body>
</html>
