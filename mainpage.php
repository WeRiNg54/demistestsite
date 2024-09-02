<?php
// Включаем отображение ошибок для диагностики
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Подключаем к базе данных
include "config.php";

// Запрашиваем три последние новости
$query = "SELECT title, newstext, newsdate FROM newsform ORDER BY newsdate DESC LIMIT 3";
$result = mysqli_query($link, $query) or die("Ошибка выполнения запроса: " . mysqli_error($link));

?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Главная страница</title>
        <link rel="stylesheet" href="newsstyle.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="news-container">
            <h1>Последние новости</h1>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Получаем первое предложение текста
                    $firstSentence = strtok($row["newstext"], '.');

                    echo "<div class='news-item'>";
                    echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
                    echo "<p>" . htmlspecialchars($firstSentence) . ".</p>";
                    echo "<div class='date'>" . htmlspecialchars($row["newsdate"]) . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Нет новостей.</p>";
            }

            $link->close();
            ?>
        </div>

    <!-- Ссылка на страницу со всеми новостями -->
        <div class="links">
            <a href="newspage.php">Посмотреть все новости</a>
            <br>
            <a href="feedback.php">Обратная связь</a>
        </div>
    </body>
</html>