<? error_reporting(E_ALL ^ E_NOTICE); 
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

  if(!isset($logged_user)){
    header("Location: index.php");
    exit;
  }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title><? echo $Lang['Registration']?></title>

<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="700" border="0" align="center" bgcolor="#FFFFFF" class="main_border" cellspacing="0" cellpading="0">
 <? include("blocks/header.php");?>
  <tr>
    <td class="form"><p><strong class="zagol"><? echo $Lang['Page_of_registration'];?></strong></p>
    
    <p><label><form action="form_add.php" method="POST" name="form"/></label></p>
    
<p class="form1"><label><? echo $Lang['Your_name'];?><br> <input name="name" type="text" size="30" maxlength="40"/></label></p>

<p class="form1"><label><? echo $Lang['Your_last_name'];?><br> <input name="surname" type="text" size="30" maxlength="40"/></label></p>

<p class="form1"><label><? echo $Lang['Your_login'];?><br> <input name="login" type="text" size="30" maxlength="40"/></label></p>

<p class="form1"><label><? echo $Lang['Your_password'];?><br> <input name="password" type="password" size="30" maxlength="40"/></label>
</p>
<p class="form1"><label><? echo $Lang['Confirmation_to_the_password'];?><br> <input name="passwordd" type="password" size="30" maxlength="40"/></label></p>

<p class="form1"><label><? echo $Lang['Your_e_mail'];?><br> <input name="email" type="text" size="30" maxlength="40"/></label></p>

<input name="date_reg" type="hidden" value="reg">

<p class="form1"><label><input name="submit" type="submit" value="<? echo $Lang['Will_register_oneself'];?>"/></label></p>
</form>

<p><form action="index.php" method="GET" name="form3"></p>

<p class="form1"><input name="submit" type="submit" value="<? echo $Lang['Will_not_register_oneself'];?>"/></p>
</form>


  </td></tr>
 <? include("blocks/footer.php");?>
</table>
</body>
</html>
