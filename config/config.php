<?php 

// файл config.php -- конфиг сайта 
// здесь находятся описания "системных" переменных 
// и классов, которые участвуют в работе приложения 

            // переменные для работы с базой данных 
            $servername = getenv('IP');
            $username = getenv('C9_USER');
            $password = "";
            $database = "topface";

                // расширение класса mysqli 
                // чтобы не нужно было писать дополнительных проверок соединения 
                // c базой данных 
                
                class pmysqli extends mysqli {
                     public function __construct($host, $name, $pass, $database) {
                         parent::__construct($host, $name, $pass, $database); 
                         
                         if (mysqli_connect_error()) {
                             die ("ERROR!");
                         }
                         
                     }
                }
                
                                             
                // соединяемся с сервером и подключаем базу данных    
                $connect = new pmysqli($servername, $username, $password, $database); 
                
                
   // здесь описаны классы для работы веб-приложения
   // вывод главной страницы сайта страницы 
    class site {
        public function enter() {
            include("assets/index.php");
        }
    }
    
    

  // класс для создания кнопки
  class HTML  {
      
      private $defaultType; 
      private $defaultName; 
      private $defaultStyleClass; 
      
      public function __construct() {
          
          $this->defaultType = 'button'; 
          $this->defaultName = 'DEFAULT';
          $this->defaultStyleClass = 'default-button';
          
      }
      
      public function field($type, $name, $styles) {
          if (isset($type) && isset($name) && isset($styles)) {
              if ($type == "button") {
                echo "<". $type . " class='" . $styles . "'>" . $name . "</" . $type .">";
              }
              else {
                echo "<". $this->defaultType . " class='" . $this->defaultStyleClass . "'>" . $this->defaultName . "</" . $type . ">";
              }
          }
      }
  }