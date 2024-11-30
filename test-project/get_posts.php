<?php
$value = $_POST["value"];
if (strlen($value) < 3) {
    echo "Поиск работает от 3 символов";
}

else {
    try {
        $conn = new PDO("mysql:host=MySQL-8.0;dbname=testProject", "root", ""); //Подключаемся к бд
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    
    $select_posts = ("SELECT p.title, GROUP_CONCAT(c.comment SEPARATOR '\t') FROM Posts p
    INNER JOIN Comments c ON c.post_id = p.post_id
    WHERE c.comment LIKE '%$value%' GROUP BY p.post_id ORDER BY p.post_id ASC");
    
    $result = $conn->query($select_posts);
    
    while ($row = $result->fetch()) {
        $comments = explode("\t", $row[1]);
        echo "<div class = 'element'>
        <h3>Заголовок записи: </h3><p>".$row[0]."</p>";
        foreach ($comments as $comment) {
            echo "<h3>Комментарий: </h3><p class = 'comment'>".$comment."</p>";
        }
        echo"</div>";
    }
}
