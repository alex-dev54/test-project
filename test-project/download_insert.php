<?php

try {
	$conn = new PDO("mysql:host=MySQL-8.0;dbname=testProject", "root", ""); //Подключаемся к бд
} catch (PDOException $e) {
	die($e->getMessage());
}

$content_posts = file_get_contents("https://jsonplaceholder.typicode.com/posts"); //Собираем данные постов в JSON формате
$content_comments = file_get_contents("https://jsonplaceholder.typicode.com/comments"); //Собираем данные комментариев в JSON формате

$data_posts = json_decode($content_posts, true); //Преобразуем данные постов в массив
$data_comments = json_decode($content_comments, true); //Преобразуем данные комментариев в массив

$count_posts = 0;
$count_comments = 0;

$insert_posts = "INSERT INTO Posts (user_id, title, content) VALUES (:userId, :title, :content)"; //SQL запрос на добавление постов в бд
$insert_comments = "INSERT INTO Comments (post_id, username, email, comment) VALUES (:postId, :username, :email, :comment)"; //SQL запрос на добавление комментариев в бд
$stmt = $conn->prepare($insert_posts);

foreach ($data_posts as $value) {
    $stmt->execute(array(":userId" => $value['userId'], ":title" => $value['title'], ":content" => $value['body'])); //вставляем подготовленные значения в SQL запрос
    $count_posts++;
}

$stmt = $conn->prepare($insert_comments);

foreach ($data_comments as $value) {
    $stmt->execute(array(":postId" => $value['postId'], ":username" => $value['name'], ":email" => $value['email'], ":comment" => $value['body'])); //вставляем подготовленные значения в SQL запрос
    $count_comments++;
}

echo "<script>console.log('Загружено ". $count_posts ." записей и ". $count_comments ." комментариев' );</script>"; //Вывод в консоль количества добавленных постов и комментариев