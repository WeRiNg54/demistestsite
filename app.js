const form = document.forms["form"];
const button = form.elements["button"];

const formArr = Array.from(form);
const validFormArr = [];

formArr.forEach((el) => {
    if (el.hasAttribute("data-reg")) {
        el.setAttribute("is-valid", "0");
        validFormArr.push(el);
    }
})

form.addEventListener("input", inputHandler);
form.addEventListener("submit", formCheck);

function inputHandler({target}) {
    if (target.hasAttribute("data-reg")) {
        inputCheck(target);
    }
}

function inputCheck(el) {
    const inputValue = el.value;
    const inputReg = el.getAttribute("data-reg");
    const reg = new RegExp(inputReg);
    if (reg.test(inputValue)){
        el.style.border = "2px solid rgb(0, 196, 0)";
        el.setAttribute("is-valid", "1");
    }
    else{
        el.style.border = "2px solid rgb(196, 0, 0)";
        el.setAttribute("is-valid", "0");
    }
}

function formCheck(e) {
    e.preventDefault();
    const allValid = [];
    validFormArr.forEach((el) => {
        allValid.push(el.getAttribute("is-valid"));
    });
    const isAllValid = allValid.reduce((acc, current) => {
        return acc && current;
    });
    if (!Boolean(Number(isAllValid))) {
        alert("Заполните поля правильно!");
        return;
    }
    formSubmit();
}

async function formSubmit() {
    const data = serializeForm(form);
    const response = await sendData(data);
    if (response.ok) {
        alert("Форма успешно отправлена!");
        addNewRow(data); // Добавляем новую строку в таблицу
        formReset();
    } else {
        alert("Код ошибки: " + response.status);
    }
}

function serializeForm(formNode) {
    return new FormData(form);
}

async function sendData(data) {
    return await fetch("sendform.php", {
        method: "POST",
        body: data,
    });
}

function addNewRow(formData) {
    // Извлекаем данные из FormData
    const newRow = document.createElement('tr');
    formData.forEach((value, key) => {
        const cell = document.createElement('td');
        cell.textContent = value;
        newRow.appendChild(cell);
    });

    // Находим тело таблицы и добавляем новую строку
    const fileTableBody = document.getElementById('fileTableBody');
    fileTableBody.appendChild(newRow);
}

function formReset() {
    validFormArr.forEach((el) => {
        form.reset();
        el.setAttribute("is-valid", 0);
        el.style.border = "none";
    });
}
