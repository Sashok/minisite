<? error_reporting(E_ALL ^ E_NOTICE); 
@session_start();
$_SESSION['name']=$name;
$_SESSION['surname']=$surname;
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
  include("blocks/bd.php");
  if (isset($_POST['name']))         {$name=$_POST['name']; if ($name=='') {unset($name);} }

if (isset($_POST['surname']))    {$surname=$_POST['surname']; if ($surname=='') {unset($surname);} }

if (isset($_POST['login']))           {$login=$_POST['login']; if ($login=='') {unset($login);} }

if (isset($_POST['password']))   {$password=$_POST['password']; if($password=='') {unset($password);} }

if(isset($_POST['email']))           {$email=$_POST['email']; if ($email=='') {unset($email);} }

if(isset($_POST['load']))           {$load=$_POST['load'];   if ($load=='') {unset($load);} }

if(isset($_POST['id']))           {$id=$_POST['id']; }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title><? echo($Lang['Welcome']);?></title>

<link href="style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<table width="700" border="0" align="center" bgcolor="#FFFFFF" class="main_border" cellspacing="0" cellpading="0">
 <? include("blocks/header.php");?>
  <tr class="body">
    <td valign="top"><table width="100%" border="0"  class="body">
      <tr class="news">
        <? include("blocks/lefttd.php");?> 
        <td valign="top"> 
        
         <?
	 		  echo($Lang['Welcome_on_the_main_page_of_website']."<br><br>" );
		  		  		  
		  ?>
		  <? 	 $result = mysql_query("SELECT * FROM anketa WHERE login='$login'",$db);
		 $myrow = mysql_fetch_array($result);
		 echo  ($Lang['Your_name'])."<br><strong>". $myrow['name']."</strong><br><br>" ;
		echo  ($Lang['Your_last_name'])."<br><strong>". $myrow['surname']."</strong><br><br>" ;
		echo  ($Lang['Your_e_mail'])."<br><strong>". $myrow['email']."</strong><br><br>" ;
		 echo  ($Lang['Date_reg'])."<br><strong>". $myrow['date_reg']."</strong><br><br>" ;
		 echo  ($Lang['Date_log'])."<br><strong>". $myrow['date_log']."</strong><br><br>" ;
		 


		?>
		        </td>
      </tr>
    </table></td>
  </tr>
 <? include("blocks/footer.php");?>
</table>
</body>
</html>
