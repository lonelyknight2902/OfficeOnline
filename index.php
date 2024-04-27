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
      if (!isset($_COOKIE['user'])) {
        header("location: /index.php?page=login");
      } else {
        include 'views/overview.html';
      }
      break;
    case 'users':
      if (!isset($_COOKIE['user'])) {
        header("location: /index.php?page=login");
      } else {
        include 'views/users.html';
      }
      break;
    case 'create-user':
      if (!isset($_COOKIE['user'])) {
        header("location: /index.php?page=login");
      } else {
        include 'views/create-user.html';
      }
      break;
    case 'tasks':
      if (!isset($_COOKIE['user'])) {
        header("location: /index.php?page=login");
      } else {
        include 'views/tasks.html';
      }
      break;
    case 'create-task':
      if (!isset($_COOKIE['user'])) {
        header("location: /index.php?page=login");
      } else {
        include 'views/create-task.html';
      }
      break;
    case 'task':
      if (!isset($_COOKIE['user'])) {
        header("location: /index.php?page=login");
      } else {
        include 'views/task.html';
      }
      break;
    default:
      if (!isset($_COOKIE['user'])) {
        header("location: /index.php?page=login");
      } else {
        include 'views/overview.html';
      }
      break;
  }
} else {
  include 'views/overview.html';
}
