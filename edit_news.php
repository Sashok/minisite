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
<title><? echo $Lang['Editing_of_news'];?></title>
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
		   <p class="users2"><? echo($Lang['Editing_of_news']);?></p>
        <?
	  if (!isset($id))
	  
	   {
	   $id_user = $_SESSION['user_id'];
	   $result = mysql_query("SELECT title, id FROM new WHERE id_user = {$id_user}  ORDER BY id DESC");
       $myrow = mysql_fetch_array($result);
		  
		do{
		printf("<p><a href='edit_news.php?id=%s'>%s</a></p>",$myrow["id"], $myrow["title"]);
		}  
		while ($myrow = mysql_fetch_array($result));
		}
		else{
		$result = mysql_query("SELECT * FROM new WHERE id='$id'");
       $myrow = mysql_fetch_array($result);
		print <<<HERE
		
		 <form name="form1" method="post" action="update_news.php">
            <p>
              <label>$Lang[Name_of_news]<br>
                <input  value="$myrow[title]" type="text" name="title" id="title" size = "40"> 
                </label>
            </p>
           
            <p>
              <label>$Lang[Complete_text_of_news]<br>
              <textarea name="text" id="text" cols="50" rows="20">$myrow[text]</textarea>
              </label>
            </p>
            <p>
             <input value="$myrow[author]" type="hidden" name="author" id="author" size = "40">
            </p>
			<input name="id" type="hidden" value="$myrow[id]">
            <p>
              <label>  
              <input type="submit" name="submit" id="submit" value="$Lang[To_edit_news]">
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