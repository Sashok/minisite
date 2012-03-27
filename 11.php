<? if (!empty($_FILES['load'])) {
  $load=$_FILES['load']['name']; 
  $load = trim($load); 
        if ($load =='' or empty($fupload)) {
   unset($fupload);
        }
 }
 
if (!isset($load) or empty($load) or $load =='') {
  $picture = "img/default.jpg"; 
 } else {
  $path_to_150_directory = 'pictures/';
        if (preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['load']['name'])) {                 
   $filename = $_FILES['load']['name'];
            $source = $_FILES['load']['tmp_name']; 
            $target = $path_to_150_directory.$filename;
            move_uploaded_file($source, $target);
            if (preg_match('/[.](GIF)|(gif)$/',$filename)) {
    $im = imagecreatefromgif($path_to_150_directory.$filename);
            }
            if(preg_match('/[.](PNG)|(png)$/',$filename)) {
                $im = imagecreatefrompng($path_to_150_directory.$filename);
            }
            if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/',$filename)) {
    $im = imagecreatefromjpeg($path_to_150_directory.$filename);
            }                    
   $w = 150;
            $w_src = imagesx($im);
            $h_src = imagesy($im);
            $dest = imagecreatetruecolor($w,$w);
            if ($w_src>$h_src) 
    imagecopyresampled($dest, $im, 0, 0, round((max($w_src,$h_src)-min($w_src,$h_src))/2), 0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));
            if ($w_src<$h_src) 
                imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));           
            if ($w_src==$h_src) 
                imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src);           
   $date=time();
            imagejpeg($dest, $path_to_150_directory.$date.".jpg");         
   $picture = $path_to_150_directory.$date.".jpg";
   $delfull = $path_to_150_directory.$filename; 
            unlink($delfull);
        } else {
   exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>$lang[err5]</body></html>");
            }
  }