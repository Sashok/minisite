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
include ("blocks/bd.php");
if(isset($_POST['title'])) {$title=$_POST['title']; if ($title=='') {unset($title);} }

if(isset($_POST['text'])) {$text=$_POST['text']; if ($text=='') {unset($text);} }

if(isset($_POST['author'])) {$author=$_POST['author']; if ($author=='') {unset($author);} }

if (isset($_POST['id']))		        {$id=$_POST['id'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title><? echo $Lang['Updating_of_news'];?></title>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<table width="700" border="0" align="center" bgcolor="#FFFFFF" class="main_border" cellspacing="0" cellpading="0">
 <? include("blocks/header.php");?>
  <tr class="body">
    <td valign="top">
    	<table width="100%" border="0"  class="body">
     		 <tr class="news">
        <? include("blocks/lefttd.php");?> 
        <td valign="top">
        <?php 
		if (isset($title)  && isset($text) && isset($author))
		{
		$result = mysql_query("UPDATE new SET title = '$title', text='$text', author='$author'  WHERE id='$id'");
		
		if ($result == 'true') 
		{echo "<p>$Lang[Your_news_are_successfully_edited]</p>";} 
		else 
		{echo "<p>$Lang[Your_news_are_not_edited]</p>";}
		}
		else
		{
		echo "<p>$Lang[You_entered_not_all_information_that_is_why_news_in_a_base_can_not_be_edited]</p>";
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