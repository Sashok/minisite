
<?
if (empty($_FILES['load']['name']))
{
//���� ���������� �� ���������� (������������ �� �������� �����������),�� ����������� ��� ������� �������������� �������� � �������� "��� �������"
$avatar = "img/default.jpg"; //������ ���������� net-avatara.jpg ��� ����� � ����������
}

else 
{
//����� - ��������� ����������� ������������
$path_to_150_directory = 'minisite/img/';//�����, ���� ����� ����������� ��������� �������� � �� ������ �����

	
if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['load']['name']))//�������� ������� ��������� �����������
	 {	
	 	 	
		$filename = $_FILES['load']['name'];
		$source = $_FILES['load']['tmp_name'];	
		$target = $path_to_90_directory . $filename;
		move_uploaded_file($source, $target);//�������� ��������� � ����� $path_to_90_directory

	if(preg_match('/[.](GIF)|(gif)$/', $filename)) {
	$im = imagecreatefromgif($path_to_90_directory.$filename) ; //���� �������� ��� � ������� gif, �� ������� ����������� � ���� �� �������. ���������� ��� ������������ ������
	}
	if(preg_match('/[.](PNG)|(png)$/', $filename)) {
	$im = imagecreatefrompng($path_to_90_directory.$filename) ;//���� �������� ��� � ������� png, �� ������� ����������� � ���� �� �������. ���������� ��� ������������ ������
	}
	
	if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {
		$im = imagecreatefromjpeg($path_to_90_directory.$filename); //���� �������� ��� � ������� jpg, �� ������� ����������� � ���� �� �������. ���������� ��� ������������ ������
	}
	
//�������� ����������� ����������� � ��� ����������� ������ ����� � ����� www.codenet.ru

// �������� �������� 150*150
// dest - �������������� ����������� 
// w - ������ ����������� 
// ratio - ����������� ������������������ 

$w = 150;// ����������  150x150. ����� ��������� � ������ ������.

// ������ �������� ����������� �� ������ 
// ��������� ����� � ���������� ��� ������� 
$w_src = imagesx($im); //��������� ������
$h_src = imagesy($im); //��������� ������ �����������

         // ������ ������ ���������� �������� 
         // ����� ������ truecolor!, ����� ����� ����� 8-������ ��������� 
         $dest = imagecreatetruecolor($w,$w); 

         // �������� ���������� ��������� �� x, ���� ���� �������������� 
         if ($w_src>$h_src) 
         imagecopyresampled($dest, $im, 0, 0,
                          round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                          0, $w, $w, min($w_src,$h_src), min($w_src,$h_src)); 

         // �������� ���������� �������� �� y, 
         // ���� ���� ������������ (���� ����� ���� ���������) 
         if ($w_src<$h_src) 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w,
                          min($w_src,$h_src), min($w_src,$h_src)); 

         // ���������� �������� �������������� ��� ������� 
         if ($w_src==$h_src) 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src); 
		 

$date=time(); //��������� ����� � ��������� ������.
imagejpeg($dest, $path_to_90_directory.$date.".jpg");//��������� ����������� ������� jpg � ������ �����, ������ ����� ������� �����. �������, ����� � �������� �� ���� ���������� ����.

//������ ������ jpg? �� �������� ����� ���� ����� + ������������ ������������ gif �����������, ������� ��������� ������������. �� ����� ������� ������ ��� �����������, ����� ����� ����� ��������� �����-�� ��������.

$avatar = $path_to_90_directory.$date.".jpg";//������� � ���������� ���� �� �������.

$delfull = $path_to_90_directory.$filename; 
unlink ($delfull);//������� �������� ������������ �����������, �� ��� ������ �� �����. ������� ���� - �������� ���������.
}
else 
         {
		 //� ������ �������������� �������, ������ ��������������� ���������
         
exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>������ ������ ���� � ������� <strong>JPG,GIF ��� PNG</strong></body></html>"); //������������� ���������� ���������

	     }
//����� �������� �������� � ���������� ���������� $avatar ������ ����������� ���
}