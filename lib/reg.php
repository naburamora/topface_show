<?php

  $config_dir = "config";
  $config_name = "config"; 
  require('../' . $config_dir . "/" . $config_name  .  ".php");
  session_start();
  
  class Reg {

       private $login;
       private $pass; 
       private $pass_repeat; 
       
       public function __construct() {
            $this->login = '';
            $this->pass = '';
            $this->pass_repeat = '';
       }
       
        public function beforeAdding() {
            
            if (!isset($_POST['addlogin']) && !isset($_POST['addpass']) && !isset($_POST['addpass_r'])) {
                echo "Данные отсутствуют, повторите попытку!";
                exit();
            }
            
                
                $name = trim($_POST['addlogin']);
                $pass = trim($_POST['addpass']);
                $repeat = trim($_POST['addpass_r']);
                
                echo "<b>Попытка регистрации</b> <br/><br/>";
        
                         
                 
                if ($name == "" || $pass == "" || $repeat == "") {
                    echo "<br/>Заполните нужные поля!";
                    exit();
                }
          
                    if (strlen($name) < 3 || strlen($name) > 15) {
                       echo "<br/>Имя должно содержать от 3 до 15 символов"; 
                       exit();
                    }

    
                
                if ($pass !== $repeat) {
                    echo "<br/>Пароли не совпадают!";
                    exit();
                }
                
                
                if ($name !== "" && $pass !== "" && $repeat !== "") {
                    
                    $this->login = $name; 
                    $this->pass = md5(md5($pass));
                    $this->pass_repeat = $repeat; 
                    
                   if (!preg_match("/^[a-zA-Z0-9]+$/", $name)) {
                       
                        echo "<br/>Имя пользователя начинается с буквы и может содержать латинские буквы и цифры!";
                        exit();
                     
                    }
                 
                }
                
                return 0; 
                
        }
        
        public function createHash() {
            
            $key = 'a.b.c.d.e.f.g.h.i.j.k.1.2.3.4.5.6.7.8.9';
            $key = explode(".", $key);
            $n = count($key); 
            $hash_string = '';
            
                for ($i = 0; $i <= $n; $i++) {
                    $char = mt_rand(0, $n);
                    $hash_string .= $key[$char];
                }
                
                return $hash_string;
            
        }
 }
  
  
  // подключение класса регистрации
  // проверка формы регистрации
  $enter = new Reg();
  
  // если все успешно (возвращаемый код метода = 0),
  // то идем дальше
  if ($enter->beforeAdding() == 0) {
      
   
                    // проверяем, был ли зарегистрирован пользователь ранее 
                    // для этого вытаскиваем из базы логин с хэш-строкой, значение которой совпадает с куки-файлом, в котором так же 
                    // хранится хэш-строка
                    
                    if ($result = $connect->query("SELECT user_login FROM users WHERE user_hash='" . $_COOKIE['hash'] . "' " )) {
                        
                        // если такой пользователь хотя бы один есть, выводим сообщение и завершаем скрипт 
                        if ($result->num_rows > 0) {
                        
                            $row = $result->fetch_assoc(); 
                            echo "Вы недавно зарегистрировались как  <b>" . $row['user_login'] . "</b><br/>";
                            $mleft = $_COOKIE['hash'][0];
                            $mright = $_COOKIE['hash'][1];
                            
                                $m = ( int ) $mleft.$mright;
                                $now = date("i");
                        
                                    $when = ($m + 15) - $now; 
                                        echo "Следующая регистрация будет доступна через "; 
                                        echo "<b>";
                                                if ($when >= 5) echo $when . " минут";
                                                if ($when < 5 && $when > 1) echo $when . " минуты";
                                                if ($when == 1) echo $when . " минуту";
                                        echo "</b>";
                                        exit();
                        }
                            
                            $result->close();
                    }

                    // проверка: есть ли уже такой же логин в базе
                    // делаем выборку по имени - если количество больше нуля, 
                    // то оповещаем пользователя, что введенный логин уже занят, и просим выбрать другое имя
                    
                    if ($result = $connect->query("SELECT user_login FROM users WHERE user_login='" . $_POST['addlogin'] . "' ")) {
                        
                        if ($result->num_rows > 0) {
                                echo "На сайте уже есть пользователь с таким именем. <br/>";
                                echo "Пожалуйста, выберите другое имя.";
                                exit();
                        }
                        
                        $result->close();
                    }
                    
                    // если ничего "свыше" этих строк не помешало, 
                    // значит пользователь может спокойно зарегистрироваться 
                    
                    echo "Завершение регистрации<br/>";
                    
                    $user = $_POST['addlogin'];
                    $pass = md5(md5($_POST['addpass']));
                    $ip = 'INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '")';
        
                            $hash = $enter->createHash(); 
                            $time = date("i");
                            $hash = $time.$hash; 
                    
                                        // если не получилось добавить пользователя в базу данных
                                        if(!$result = $connect->query("INSERT INTO users VALUES (NULL, '$user', '$pass', '$hash', $ip) ")) {
                                            
                                            // оповещаем, что произошла ошибка 
                                            // выходим из скрипта 
                                            
                                            echo "Ошибка";
                                            exit();
                                            $result->close();

                                        }
                                                
                                            else {
                                                
                                                // оповещаем пользователя, что все удачно
                                                echo "Успех!";
                                                
                                                        // устанавливаем печеньки на 15 минут 
                                                        // то есть в течение 15 минут нельзя будет зарегистрироваться повторно
                                                        // с того же компьютера 
                                                        
                                                        // первые куки - имя пользователя (одновременно предназначенно и для авторизации)
                                                        setcookie("login", $user, time()+900);
                                                        // вторые куки - хэш-строка, генерируемая через простой подбор символов 
                                                        // туда мы прячем время (минуты), в которые была сделана регистрация
                                                        setcookie("hash", $hash, time()+900);
                                                        
                                                        $_SESSION['username'] = $_POST['addlogin'];
                                                        echo "<meta http-equiv='refresh' content='0; url=' />";

                        
                    }
  }