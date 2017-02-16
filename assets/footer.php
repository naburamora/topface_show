<!-- ФАЙЛ FOOTER.PHP --> 

<footer>
    <div style="padding: 25px; ">
      <p>2017 &copy; RR for Topface</p>
      <p>
      <?php
          if (empty($_SESSION['username'])) {
            echo "Здравствуйте, Уважаемый Гость!";
            
            
          }
          else {
            echo "Привет, " . $_SESSION['username'] . "!";
          }
      ?></p>
    </div>
</footer>