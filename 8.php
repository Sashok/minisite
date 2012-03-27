<? if (empty($_FILES['fupload']['name'])) 
{ //если переменной не существует (пользователь не отправил изображение),то присваиваем ему заранее приготовленную картинку с надписью "нет аватара" 
$avatar = "avatars/net-avatara.jpg"; 
//можете нарисовать net-avatara.jpg или взять в исходниках }  
else  { //иначе - загружаем изображение пользователя 
$path_to_150_directory = 'avatars/';
//папка, куда будет загружаться начальная картинка и ее сжатая копия  
  if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['fupload']['name']))
  //проверка формата исходного изображения  
  {   
  $filename = $_FILES['fupload']['name']; 
  $source = $_FILES['fupload']['tmp_name'];    
  $target = $path_to_90_directory . $filename;  
  move_uploaded_file($source, $target);
  //загрузка оригинала в папку $path_to_90_directory 
  if(preg_match('/[.](GIF)|(gif)$/', $filename)) 
  {  $im = imagecreatefromgif($path_to_90_directory.$filename) ; 
  //если оригинал был в формате gif, то создаем изображение в этом же формате. Необходимо для последующего сжатия 
  }
  if(preg_match('/[.](PNG)|(png)$/', $filename)) {  $im = imagecreatefrompng($path_to_90_directory.$filename) ;
  //если оригинал был в формате png, то создаем изображение в этом же формате. Необходимо для последующего сжатия  
  }    
  if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {   $im = imagecreatefromjpeg($path_to_90_directory.$filename); 
  //если оригинал был в формате jpg, то создаем изображение в этом же формате. Необходимо для последующего сжатия  
  }   
  //СОЗДАНИЕ КВАДРАТНОГО ИЗОБРАЖЕНИЯ И ЕГО ПОСЛЕДУЮЩЕЕ СЖАТИЕ ВЗЯТО С САЙТА www.codenet.ru 
  // Создание квадрата 150*150 // dest - результирующее изображение  
  // w - ширина изображения
  // ratio - коэффициент пропорциональности   
  $w = 150;
  // квадратная  150x150. Можно поставить и другой размер. 
  // создаём исходное изображение на основе  
  // исходного файла и определяем его размеры 
  $w_src = imagesx($im); 
  //вычисляем ширину
  $h_src = imagesy($im); 
  //вычисляем высоту изображения        
  // создаём пустую квадратную картинку          
  // важно именно truecolor!, иначе будем иметь 8-битный результат        
  $dest = imagecreatetruecolor($w,$w);          
  // вырезаем квадратную серединку по x, если фото горизонтальное        
  if ($w_src>$h_src)   
  imagecopyresampled($dest, $im, 0, 0,                    
  round((max($w_src,$h_src)-min($w_src,$h_src))/2),    
  0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));        
  // вырезаем квадратную верхушку по y,       
  // если фото вертикальное (хотя можно тоже серединку)      
  if ($w_src<$h_src)       
  imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w,    
  min($w_src,$h_src), min($w_src,$h_src));     
  // квадратная картинка масштабируется без вырезок     
  if ($w_src==$h_src)         
  imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src);    
  $date=time(); 
  //вычисляем время в настоящий момент. 
  imagejpeg($dest, $path_to_90_directory.$date.".jpg");
  //сохраняем изображение формата jpg в нужную папку, именем будет текущее время. Сделано, чтобы у аватаров не было одинаковых имен.  
  //почему именно jpg? Он занимает очень мало места + уничтожается анимирование gif изображения, которое отвлекает пользователя. Не очень приятно читать его комментарий, когда краем глаза замечаешь какое-то движение.
  $avatar = $path_to_90_directory.$date.".jpg";
  //заносим в переменную путь до аватара.
  $delfull = $path_to_90_directory.$filename;  
  unlink ($delfull);
  //удаляем оригинал загруженного изображения, он нам больше не нужен. Задачей было - получить миниатюру. 
  } 
  else           {    //в случае несоответствия формата, выдаем соответствующее сообщение          
  