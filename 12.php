if (isset($_POST['register']))
    {
//-------------------------------------------Перевірка користувача---------------------------------
     if (!empty($userName)) 
        {  
            $query = "
                SELECT
                    *
                FROM 
                    user
                WHERE 
                    user.name = '{$userName}'
         ";
            $result = mysql_query( $query ) or die( "Query failed : " . mysql_error() );
            $global_count= mysql_fetch_row($result);
            
            if ($$global_count[1]==$userName)
                {
                    print('User '.$$global_count[1].' is registered <br />');
                    $print_error=1; 
                }
            if (preg_match($regex, $userName))
                {
                    print('invalid User Name <br />');
                    $print_error=1;
                } 
            if (strlen($userName)>20)
                {
                    print('user name very long max 20<br />');
                    $print_error=1;
                } 
        }
    if (empty($userName))
        {
            print "error user name!<br />";
            $print_error = 1;
        }

//-----------------------------------------Перевірка пароля------------------------------------------------------
     if (!empty($password))
        {
            if (preg_match($regex, $password))
                {
                    print('invalid password <br />');
                    $print_error=1;
                }
            if (strlen($password)<3 and !empty($password))
                {
                    print('password very short min 3 <br />');
                    $print_error=1;    
                }

            if ($password!=$configPass or empty($configPass))
                {
                    print('Error Config Password <br />');
                    $print_error=1;    
                }        
        } 
    if (empty($password))
        {
            print "Error password <br />";
            $print_error = 1;
        }
//-----------------------------------------Перевірка E-mail------------------------------------------------------            
        if (!empty($email))
            {
                $query = "
                    SELECT
                        *
                    FROM 
                        user
                    WHERE 
                        user.email = '{$email}'
             ";
                $result = mysql_query( $query ) or die( "Query failed : " . mysql_error() );
                $global_count = mysql_fetch_row($result);
                if (!preg_match($regEmail,$email))
                    {   
                                                
                        print('Invalid Email');
                        $print_error=1;
                    }
                                
                if (strlen($email)>40)
                    {
                        print('e-mail very long <br />');
                        $print_error=1;                
                    }
 
                if ($global_count[3]==$email)
                    {
                        print('E-mail '.$global_count[3].' is registered <br />');
                        $print_error=1; 
                    }
            }
        
       if (empty($email))
            {
                print "Error E-mail! <br />";
                $print_error = 1;
            }
            
//-------------------------------------Провірка чи всі дані вірні----------------------------------------------------
        if (empty($print_error))
            {
               // print('All fields are correct');
                $query=" 
                    INSERT INTO user VALUES ('NULL','{$userName}','{$password}','{$email}','user','','','','".date('d.m.Y') ."','".date('d.m.Y H:i:s')."')";
                mysql_query( $query ) or die( "Query failed : " . mysql_error() );
               
               //var_dump($id);