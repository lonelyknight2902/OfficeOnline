<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  switch ($page) {
    // case 'products':
    //   include 'products.php';
    //   break;
    // case 'create':
    //   include 'create.php';
    //   break;
    case 'login':
      include 'views/login.html';
      break;
    // case 'register':
    //   include 'register.php';
    //   break;
    case 'overview':
      include 'views/overview.html';
      break;
    case 'users':
      include 'views/users.html';
      break;
    case 'tasks':
      include 'views/tasks.html';
      break;
    case 'task':
      include 'views/task.html';
      break;  
    default:
      include 'views/login.html';
      break;
  }
} else {
  include 'views/login.html';;
}
