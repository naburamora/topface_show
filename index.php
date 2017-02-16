<?php 

  // "точка входа"
  // здесь подключается конфиг и вызывается метод, который отвечает
  // за отображение главной страницы сайта 
    
  $config_dir = "config";
  $config_name = "config"; 
  require(__DIR__ . '/' . $config_dir . "/" . $config_name  .  ".php");
    
  $site = new site(); 
  $site->enter(); 