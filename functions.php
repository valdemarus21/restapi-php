<?php
header('Content-Type: application/json');

function getPosts($connect): void
{
    $posts = mysqli_query($connect, "SELECT * FROM posts");
    $postsList = array();

    while ($post = mysqli_fetch_assoc($posts)) {
        $postsList[] = $post;
    }
    echo json_encode($postsList);
}
function getPost($connect, $id): void
{
    $post = mysqli_query($connect, "SELECT * FROM posts WHERE id = '$id'");

    if(mysqli_num_rows($post) == 0)
    {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "post not found"
        ];
        echo json_encode($res);
    }
    else
    {
    http_response_code(200);
    $post = mysqli_fetch_assoc($post);
    echo json_encode($post);

    }
}
function addPost($connect, $data): void
{
    $title = $data['title'];
    $body = $data['body'];

    mysqli_query($connect, "INSERT INTO posts (title, body) VALUES ('$title', '$body')");
    http_response_code(201);
    $res = [
        "status" => true,
        "post_id" => mysqli_insert_id($connect)
    ];
    echo json_encode($res);

}
function updatePost($connect, $id, $data): void
{
    $title = $data['title'];
    $body = $data['body'];
    mysqli_query($connect, "UPDATE posts SET title = '$title', body = '$body' WHERE id = '$id'");

    http_response_code(200);
    $res = [
        "status" => true,
        "post_id" => 'post is updated'
    ];
    echo json_encode($res);

}
function deletePost($connect, $id): void
{
    mysqli_query($connect, "DELETE FROM posts WHERE id = '$id'");
    http_response_code(200);
    $res = [
        "status" => true,
        "post_id" => 'post was delated'
    ];
    echo json_encode($res);
}