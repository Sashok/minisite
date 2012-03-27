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

  if(!isset($logged_user)){
    header("Location: index.php");
    exit;
  }
 include("blocks/bd.php");
if (isset($_POST['name'])) {$name=$_POST['name'];}
if (isset($_POST['surname'])) {$surname=$_POST['surname'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title><? echo $Lang['Users'];?></title>

<link href="style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<table width="700" border="0" align="center" bgcolor="#FFFFFF" class="main_border" cellspacing="0" cellpading="0">
 <? include("blocks/header.php");?>
  <tr class="body"> 
    <td valign="top"><table width="100%" border="0" class="body">
      <tr>
      
       <? include("blocks/lefttd.php");?>
       
        <td valign="top" bgcolor="#999999">
    <a href="users.php?lang=en"><img src="img/en.png"></a> 
	<a href="users.php?lang=ua"><img src="img/ua.png"></a> 
	<a href="users.php?lang=ru"><img src="img/ru.png"></a>
        <p class="users2"><? echo($Lang['List_of_the_authorized_users']);?></p>
        <? $result = mysql_query("SELECT id, name, surname FROM anketa ORDER BY id DESC",$db);
		 $myrow = mysql_fetch_array($result);
        do {
		printf("<table>
		<tr>
		<td><p><strong>$Lang[User] %s:</strong></td>
		</tr>
		
		<tr>
		<td class='users'>%s %s</p></td>
		</tr>
		</table><br><br>",$myrow['id'],$myrow['surname'], $myrow['name']);
		}
		while ($myrow = mysql_fetch_array($result));
	
		?>
		</td>
      </tr>
    </table></td>
  </tr>
 <? include("blocks/footer.php");?>
</table>
</body>
</html>
