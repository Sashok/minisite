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
  }

 include("blocks/bd.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title><? echo $Lang['News'];?></title>

<link href="style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<table width="700" border="0" align="center" bgcolor="#FFFFFF" class="main_border" cellspacing="0" cellpading="0">
 <? include("blocks/header.php");?>
  <tr  class="body">
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <? include("blocks/lefttd.php");?>
      
        <td valign="top" class='news'>
        <p class="users2"><? echo $Lang['Choose_news_for_moving_away'];?></p>
        
        <form action="drop_news.php" method="post">
        <? 
		$result = mysql_query("SELECT id, title FROM new ORDER BY id DESC",$db);
		$myrow = mysql_fetch_array($result);
		
        do
		{
		printf("<p ><label><input name='id' type='radio' value='%s'>%s</label></p>",$myrow["id"], $myrow["title"]);
		}
		while ($myrow = mysql_fetch_array($result));
		?>
        <p><input name="submit" type="submit" value="<? echo $Lang['To_delete_news']?>" /></p>
        </form>
		</td>
      </tr>
    </table></td>
  </tr>
 <? include("blocks/footer.php");?>
</table>
</body>
</html>
