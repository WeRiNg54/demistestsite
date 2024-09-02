<?php
include "config.php";
$query = ("SELECT title, newstext, newsdate FROM newsform");
$result = mysqli_query($link, $query) or die(mysqli_error($link));
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Новости</title>
        <link rel="stylesheet" href="newsstyle.css">
    </head>
    <body>
        <div class="news-container">
            <?php
                if ($result->num_rows > 0) {
                // Вывод новостей
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='news-item'>";
                        echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
                        echo "<p>" . htmlspecialchars($row["newstext"]) . "</p>";
                        echo "<div class='date'>" . htmlspecialchars($row["newsdate"]) . "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Нет новостей.</p>";
                }
                $link->close();
            ?>
        </div>
    </body>
</html>