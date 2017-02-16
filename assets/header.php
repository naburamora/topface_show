<!-- НАЧАЛО ФАЙЛА HEADER.PHP -->
<header>
    <div style="padding: 30px;">
        <!-- Блок авторизации/отображения кнопки входа и регистрации-->
        <p>
            <?php
                
                    // если пользователь авторизован,
                    // выводим логин, под которым он авторизовался и ссылку для выхода
          
                    
                    if (!empty($_SESSION['username'])) {
                        echo "<b>" . $_SESSION['username'] . "</b><br/><br/>";
                        echo " <a href='../lib/auth.php?logout=1' target='_top'>выйти</a>";
                    }
                    
                    // иначе: 
                    // если пользователь не авторизован, 
                    // вывести кнопку для авторизации и регистрации 
                    
                    else {
                         
                         // подключаем класс HTML
                         // данная манипуляция была сделана за тем, 
                         // чтобы подключились стили из css-файла <main.css>,
                         // что обычный вывод тега button через echo наотрез отказывался делать 
                         
                         $button = new HTML();
                         $button->field("button", "Войти", "button-log-in");
                         $button->field("button", "Регистрация", "button-reg-in");
                    }
            ?>
        </p>
    </div>
</header>
  
  <!-- фон, отображаемый при появлении окна регистрации -->
  <div id='reg-background'></div>
  
    <!-- окно регистрации --> 
    <div id="reg-window">
         <!-- закрыть окно регистрации -->
         <img id="action-close" width="35px" height="35px" src="../assets/img/close.png" /> 
         
         <p class='title'>Регистрация</p>   
             <p class='about'>Быстрая регистрация нового пользователя</p>
                 
             <p style="color: grey; font-size: 11pt; font-weight: 300;"> <span style="color: #ae2a17;">*</span> - необходимые поля для заполнения</p>
                 <br/><br/><br/>
           <dl class="height">
               <dt>Имя пользователя<span style="color: #ae2a17;">*</span></dt>
               <dd/><input type="text" name="addlogin" class="name" id="name" placeholder="Ваше имя на сайте"/></dd>
           </dl>     
              
            <dl class="height">
               <dt>Пароль<span style="color: #ae2a17;">*</span></dt>
               <dd/><input type="password" name="addpass" class="pass" id="pass" placeholder="Введите пароль" /></dd>
           </dl>
                  
            <dl class="height">
               <dt>Повторите пароль<span style="color: #ae2a17;">*</span></dt>
               <dd/><input type="password" name="addpass_r" class="pass" id="pass_r" placeholder="Пароль ещё раз" /></dd>
           </dl>
           
           <br/>
           <center>
                <button id="add-user" class="button-reg-in">Присоединиться</button>
           </center>
    </div>
    
    
    <!-- ОКНО ВХОДА НА САЙТ --> 
    
          <div id="enter-the-site">
              <center>
            <p class='title' style="color: #fff;">Вы уже здесь?</p>
            </center>
            <br/><br/>
                <dl class="height">
                  <dt>Имя пользователя</dt>
                  <dd><input type="text" id="auser" name='auser' placeholder="Логин" /></dd>
                </dl>
                <dl class="height">
                      <dt>Пароль на сайте</dt>
                      <dd><input type="password" id="apass" name='apass' placeholder="Пароль" /></dd>
                </dl>
                <dl class="height">
                    <dt></dt>
                    <dd><button id="enter-site" class="button-log-in enter">Войти в систему</button></dd>
                </dl>
          </div>

<!-- КОНЕЦ ФАЙЛА HEADER.PHP --> 