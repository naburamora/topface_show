
    // готовность скрипта после полной загрузки страницы (документа)
    $(document).ready(function () {

            // скроем форму регистрации при загрузке страницы 
            $("#reg-background").fadeOut(0);
            $("#reg-window").fadeOut(0);
            $("#enter-the-site").fadeOut(0);
        
                         $("#reg-background").click(function() {
                                $(this).fadeOut();
                                $("#reg-window").fadeOut();
                                $("#enter-the-site").fadeOut();
                                
                            });

                    // появление окна регистрации 
                    // при нажатии кнопки <Регистрация>
                    
                    $('.button-reg-in').click(function() {
                            $("#reg-background").fadeIn(200);
                            $("#reg-window").fadeIn(100);
                    });
    
                
                    // "крестик", скрывает окно, 
                    // если пользователь вдруг передумал регистрироваться 
                    $('#action-close').click(function() {
                            $("#reg-background").fadeOut(100);
                            $("#reg-window").fadeOut(50);
                    });
    
                    
                            // если пользователь нажал кнопку регистрации <Присоединиться>                                
                            $("#add-user").click(function() {
                                            
                                            // берем из полей ввода введеные значения,
                                            // чтобы отправить их скрипту через ajax-запрос 
                                            
                                            // имя 
                                            var name = $("#name").val();
                                            // пароль
                                            var pass = $("#pass").val();
                                            // повтор пароля
                                            var pass_r = $("#pass_r").val(); 
                
                                                        // вызываем ajax-запрос для передачи введенных значений 
                                                        // серверу 
                                                        $.ajax({
                                                                    // метод передачи данных POST
                                                                    // для сокрытия данных, чтобы в адресной строке ничего не промелькнуло 
                                                                    type: "POST",
                                                                    // адрес скрипта, которому пересылаем данные
                                                                    url: "../lib/reg.php",
                                                                    // сами данные 
                                                                    // благодаря ajax, инициализируем php-переменные в массиве POST
                                                                    data: "addlogin=" + name + "&addpass=" + pass + "&addpass_r=" + pass_r,
                                                                    // в случае успеха, если запрос отправлен и получен ответ от сервера, 
                                                                    // выводим полученное содержимое в элементе 'message'
                                                                    // здесь параметр msg - наши полученные данные через php-скрипт <reg.php>  
                                                                    success: function showMessage(msg) {
                                                                                // добавляем DOM-элемент 'message' в элемент 'content' 
                                                                                $("<div id=message>" + msg + "</div>").appendTo("#content")
                                                                                // немного анимации 
                                                                                .css("opacity", "0")
                                                                                 .fadeOut(0)
                                                                                   .fadeIn(50)
                                                                                      .animate({
                                                                                          opacity: "1",
                                                                                          marginLeft: "130px"
                                                                                      }, 250)
                                                                                   .delay(5000)
                                                                                 .fadeOut(5500);
                                                                            }
                                                        });
                            });
                            
                      
                            
                        // ФОРМА ВХОДА 
                        
                        $("button.button-log-in").click(function() {
                            $("#reg-background").fadeIn(250);
                            $("#enter-the-site").fadeIn(250);
                        });
                        
               
                    
                                     $("button#enter-site").click(function() {
                                var name = $("#auser").val();
                                var pass = $("#apass").val(); 
                                    
                                    $.ajax({
                                            type: "POST",
                                            url: "../lib/auth.php?logout=0",
                                            data: "auser=" + name + "&apass=" + pass,
                                            success: function getData(message) {
                                                     $("<div id=message>" + message  + "</div>").appendTo("#content")
                                                                                // немного анимации 
                                                                                .css("opacity", "0")
                                                                                 .fadeOut(0)
                                                                                   .fadeIn(50)
                                                                                      .animate({
                                                                                          opacity: "1",
                                                                                          marginLeft: "130px"
                                                                                      }, 250)
                                                                                   .delay(5000)
                                                                                 .fadeOut(5500);
                                            }
                                    });
                        });
    });