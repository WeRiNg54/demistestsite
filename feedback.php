<?php include('sendform.php');?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <title>Форма обратной связи</title>
    </head>
    <body>
        <div class="container">
            <form action="sendform.php" id="form" name="form" method="POST">
                <div class="text-field">
                    <div class="topic-text">Форма обратной связи</div>
                    <div class="input-box">
                        <input type="text" placeholder=" " id="name" name="name" data-reg="^[А-ЯЁ]*[а-яё]*[ ]" required>
                        <label class="text-field_placeholder">ФИО</label>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder=" " id="adress" name="adress" data-reg="^[г\.]*\s*[А-Яа-я\-]{2,}[\,\s]*[ул|пер|пр|б-р]*[\.\s]*[А-Яа-я\-]{2,}[\,\s]*[д\.]*\s*\d{1,3}[\\\d{1,3}]*[\,\s\-]*[кв\.]*\s*\d{0,3}\s*" required>
                        <label class="text-field_placeholder">Адрес</label>
                    </div>
                    <div class="input-box">
                        <input type="tel" placeholder=" " id="phone" name="phone" data-reg="^((\+7)+([0-9]){10})$" required>
                        <label class="text-field_placeholder">Номер телефона</label>
                    </div>
                    <div class="input-box">
                        <input type="email" placeholder=" " id="email" name="email" data-reg="^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$" required>
                        <label class="text-field_placeholder">E-mail</label>
                    </div>
                    <div class="button">
                        <input type="submit" value="Отправить" id="button" name="button">
                    </div>
            </div>
            </form>
            <table id="fileTable" style="margin-top: 20px; width: 100%;">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Адрес</th>
                    <th>Номер телефона</th>
                    <th>E-mail</th>
                </tr>
                </thead>
                <tbody id="fileTableBody">
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['adress']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script src="app.js"></script>
    </body>
</html>