<? error_reporting(E_ALL ^ E_NOTICE); 
@session_start();
// ������ ��������� ��� ������ ������
$LangArray = array("ru", "ua", "en");
// ���� �� ���������
$DefaultLang = "ua";

// ���� ���� ��� ������ � �������� � ������ ���������� ��� �������
if(@$_SESSION['NowLang']) {
	// ��������� ���� ��������� ���� �������� ��� ������
	if(!in_array($_SESSION['NowLang'], $LangArray)) {
		// ������������ �����, ���������� ���� �� ���������
		$_SESSION['NowLang'] = $DefaultLang;
	}
}
 else {
 	$_SESSION['NowLang'] = $DefaultLang;
 }

// ��������� ���� ��������� ������� ����� GET
$language = addslashes($_GET['lang']);
if($language) {
	// ��������� ���� ��������� ���� �������� ��� ������
	if(!in_array($language, $LangArray)) {
		// ������������ �����, ���������� ���� �� ���������
		$_SESSION['NowLang'] = $DefaultLang;
	}
	 else {
	 	// ��������� ���� � ������
	 	$_SESSION['NowLang'] = $language;
	 }
}

// ��������� ������� ����
$CurentLang = addslashes($_SESSION['NowLang']);
include_once ("lang/lang.".$CurentLang.".php");

  if(!isset($logged_user)){
    header("Location: index.php");
    exit;
  }

 include("blocks/bd.php");
$result = mysql_query("SELECT * FROM new WHERE id='$id'", $db);
$myrow = mysql_fetch_array($result);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title><? echo $myrow['title'];?></title>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<table width="700" border="0" align="center" bgcolor="#FFFFFF" class="main_border" cellspacing="0" cellpading="0">
 <? include("blocks/header.php");?>
  <tr class="body"> 
    <td valign="top"><table width="100%" border="0">
      <tr>
       <? include("blocks/lefttd.php");?> 
        <td valign="top" bgcolor="#999999">
       <? 
	printf("<p class='users2'><strong>%s</strong></p>
	<p>%s</p>
	<p class='users'>$Lang[Author] %s</p> ", $myrow["title"],$myrow["text"],$myrow["author"]);?>
		</td>
      </tr>
    </table></td>
  </tr>
 <? include("blocks/footer.php");?>
</table>
</body>
</html>