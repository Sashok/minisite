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
if (isset($_POST['name']))         {$name=$_POST['name']; if ($name=='') {unset($name);} }

if (isset($_POST['surname']))    {$surname=$_POST['surname']; if ($surname=='') {unset($surname);} }

if (isset($_POST['login']))           {$login=$_POST['login']; if ($login=='') {unset($login);} }

if (isset($_POST['password']))   {$password=$_POST['password']; if($password=='') {unset($password);} }

if(isset($_POST['email']))           {$email=$_POST['email']; if ($email=='') {unset($email);} }

if(isset($_POST['load']))           {$load=$_POST['load'];   if ($load=='') {unset($load);} }

if(isset($_POST['avatar ']))           {$avatar =$_POST['avatar '];   if ($avatar=='') {unset($avatar);} }

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
	$name = stripslashes($name);
    $name = htmlspecialchars($name);
    $surname = stripslashes($surname);
    $surname = htmlspecialchars($surname);
	$login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
	$email = stripslashes($email);
    $email = htmlspecialchars($email);
	$load = stripslashes($load);
    $load = htmlspecialchars($load);
	
	
	
	 $name = trim($name);
     $surname = trim($surname);
	 $login = trim($login);
     $password = trim($password);
	 $email = trim($email);
	 $load = trim($load);

	 

	 
		if (isset($name)  &&  isset($surname)  &&  isset($login)  &&  isset($password)  &&  isset($email))
		{
		$result = mysql_query("UPDATE anketa SET name = '$name', surname='$surname', login='$login', password='$password', email='$email'  WHERE id='$id' ");
		
		if ($result == true) 
		{
		echo "<p>$Lang[Your_data_are_renewed]</p>";
		} 
		else 
		{
		echo "<p>$Lang[Your_data_are_not_renewed]</p>";
		}
		}
		else
		{
		echo "<p>$Lang[You_did_not_fill_all_fields]</p>";
		} 
		
		if (!empty($_FILES['load'])) {
   $load = trim($_FILES['load']['name']);
}

if (!isset($load) || empty($load)) {
   $avatar = "img/default.jpg";
} else {

$path_to_150_directory = 'img/';

if(preg_match('/[.](jpg)|(jpeg)|(gif)|(png)$/i',$_FILES['load']['name'])) {
      $filename = $_FILES['load']['name'];
      $source = $_FILES['load']['tmp_name'];
      $target = $path_to_150_directory . $filename;
      move_uploaded_file($source, $target);

   if(preg_match('/[.](gif)$/i', $filename)) {
      $im = imagecreatefromgif($path_to_150_directory.$filename) ;
   } elseif(preg_match('/[.](png)$/i', $filename)) {
      $im = imagecreatefrompng($path_to_150_directory.$filename) ;
   } elseif(preg_match('/[.](jpg)|(jpeg)$/i', $filename)) {
      $im = imagecreatefromjpeg($path_to_150_directory.$filename);
   }

$w = 150;

$w_src = imagesx($im);
$h_src = imagesy($im);

      $dest = imagecreatetruecolor($w,$w);

      if ($w_src>$h_src)
      imagecopyresampled($dest, $im, 0, 0,
                  round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                  0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));

      if ($w_src<$h_src)
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w,
                  min($w_src,$h_src), min($w_src,$h_src));

      if ($w_src==$h_src)
      imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src);

   $date=time();
   imagejpeg($dest, $path_to_150_directory.$date.".jpg");

   $avatar = $path_to_150_directory.$date.".jpg";

   $delfull = $path_to_150_directory.$filename;
   unlink ($delfull);
   
  $load = mysql_escape_string($load);
$result2 = mysql_query("UPDATE anketa SET load='$load' WHERE id='$id'");
}
else 
         {
		 //в случае несоответствия формата, выдаем соответствующее сообщение
         
exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>Аватар должен быть в формате <strong>JPG,GIF или PNG</strong></body></html>"); //останавливаем выполнение сценариев

	     }
//конец процесса загрузки и присвоения переменной $avatar адреса загруженной авы
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