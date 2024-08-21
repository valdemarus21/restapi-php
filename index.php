<?php

//header('Content-Type: application/json');
require_once __DIR__ . '/php_connect.php';
require_once __DIR__ . '/functions.php';

$q = $_GET['q'];
$params = explode('/', $q);

$type = $params[0];
$id = $params[1];

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET')
{
    if($type === 'posts'){

        if(isset($id))
        {

            getPost($connect, $id);

        } else
        {

            getPosts($connect);

        }

    }
}
else if($method == 'POST')
{
    if($type === 'posts')
    {
        addPost($connect, $_POST);
    }
} else if($method == 'PATCH')
{
    if($type === 'posts')
    {
      if(isset($id))
      {
          $data = file_get_contents('php://input');
          $data = json_decode($data, true);
          updatePost($connect,$id, $data);
      }
    }
} else if($method == 'DELETE')
{
    if($type === 'posts')
    {
        if(isset($id))
        {
           deletePost($connect,$id);
        }
    }
}

