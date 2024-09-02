document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form');
    const fileTable = document.getElementById('fileTable');
    const fileTableBody = document.getElementById('fileTableBody');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Предотвращаем стандартное поведение отправки формы
        const formData = new FormData(form);

        fetch('', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.text())
            .then(data => {
                // Извлекаем данные из ответа и обновляем таблицу
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');

                // Извлекаем новую таблицу
                const newTable = doc.getElementById('fileTableBody');
                const newTableRows = newTable.innerHTML;

                // Обновляем таблицу
                fileTable.style.display = 'table'; // Показываем таблицу
                fileTableBody.innerHTML = newTableRows;

                // Очищаем форму
                form.reset();
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
    });
});
