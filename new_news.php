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
if(isset($_POST['id'])) {$id=$_POST['id']; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title><? echo $Lang['New_news']?></title>
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
        <? $result = mysql_query("SELECT * FROM anketa");
           $myrow = mysql_fetch_array($result);?>
          <form name="form1" method="post" action="add_news.php">
            <p>
              <label><? echo $Lang['Name_of_news'];?><br>
                <input type="text" name="title" id="title" size = "40"/>
                </label>
            </p>
           
            <p>
              <label><? echo $Lang['Complete_text_of_news'];?><br>
              <textarea name="text" id="text" cols="50" rows="20"></textarea>
              </label>
            </p>
            <p>              
              <input value="<? echo $myrow['surname']. $myrow['name'];?>" type="hidden" name="author" id="author" size = "40"/>            
            </p>
            <input name="id_user" type="hidden" value="<?php echo $myrow['id']; ?>"/>
            <p>
              <label>  
              <input type="submit" name="submit" id="submit" value="<? echo $Lang['To_add_news'];?>">
              </label>
            </p>
          </form>          </td>
      </tr>
    </table></td>
  </tr>
 <? include("blocks/footer.php");?>
</table>
</body>
</html>