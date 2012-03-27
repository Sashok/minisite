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
if (isset($_GET['id'])) {$id=$_GET['id'];}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title><? echo $Lang['Editing_of_profile'];?></title>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<table width="700" border="0" align="center" bgcolor="#FFFFFF" class="main_border" cellspacing="0" cellpading="0">
 <? include("blocks/header.php");?>
  <tr class="body">
    <td valign="top"><table width="100%" border="0"  class="body">
      <tr>
        <? include("blocks/lefttd.php");?> 
        <td valign="top" class='news'>
		<p class="users2"><? echo($Lang['Editing_of_profile']);?></p>
        <?
	  if (!isset($id))
	  
	   {
	   $login = $_SESSION['login'];
	   $result = mysql_query("SELECT id, name, surname FROM anketa WHERE login ='$login'  ");
       $myrow = mysql_fetch_array($result);
		  
		do{
		printf("<p><a href='edit_prof.php?id=%s'>%s %s </a></p>",$myrow["id"], $myrow["surname"],$myrow["name"]);
		}  
		while ($myrow = mysql_fetch_array($result));
		}
		else{
		$result = mysql_query("SELECT * FROM anketa WHERE id='$id'");
       $myrow = mysql_fetch_array($result);
		print <<<HERE
		
		 <form enctype="multipart/form-data" name="form1" method="post" action="update_prof.php" >
            <p>
              <label>$Lang[Your_name]<br>
                <input  value="$myrow[name]" type="text" name="name" id="name" size = "40"/> 
              </label>
            </p>
			<p>
              <label>$Lang[Your_last_name]<br>
                <input  value="$myrow[surname]" type="text" name="surname" id="surname" size = "40"/> 
              </label>
            </p>
			<p>
              <label>$Lang[Your_login]<br>
                <input  value="$myrow[login]" type="text" name="login" id="login" size = "40"> 
               </label>
            </p>
			<p>
              <label>$Lang[Your_password]<br>
                <input  value="$myrow[password]" type="text" name="password" id="password" size = "40"/> 
              </label>
            </p>
			<p>
              <label>$Lang[Your_e_mail]<br>
                <input  value="$myrow[email]" type="text" name="email" id="email" size = "40"/> 
               </label>
             </p>
			 <p>
			 <label>Виберіть свій аватар</br>
			 <input name="load" type="file"/>
			 </label>
			 </p>
			</p>
		   <input name="id" type="hidden" value="$myrow[id]"/>
           <p>
			<p>
              <label>  
               <input type="submit" name="submit" id="submit" value="$Lang[To_edit_information]"/>
              </label>
            </p>
          </form> 
HERE;
		}?>
      
      
        </td>
      </tr>
    </table></td>
  </tr>
 <? include("blocks/footer.php");?>
</table>
</body>
</html>