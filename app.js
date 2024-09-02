const form = document.forms["form"];
const formArr = Array.from(form);
const validFormArr = [];
const button = form.elements["button"];

formArr.forEach((el) => {
    if (el.hasAttribute("data-reg")) {
        el.setAttribute("is-valid", "0");
        validFormArr.push(el);
    }
});

form.addEventListener("input", inputHandler);
form.addEventListener("submit", formCheck);

function inputHandler({ target }) {
    if (target.hasAttribute("data-reg")) {
        inputCheck(target);
    }
}

function inputCheck(el) {
    const inputValue = el.value.trim();
    const inputReg = el.getAttribute("data-reg");
    const reg = new RegExp(inputReg);
    if (reg.test(inputValue) && inputValue !== "") {
        el.setAttribute("is-valid", "1");
        el.style.border = "2px solid rgb(0, 196, 0)";
    } else {
        el.setAttribute("is-valid", "0");
        el.style.border = "2px solid rgb(255, 0, 0)";
    }
}

function formCheck(e) {
    e.preventDefault();
    const allValid = [];
    validFormArr.forEach((el) => {
        allValid.push(el.getAttribute("is-valid"));
    });

    const isAllValid = allValid.every(value => value === "1");
    if (!isAllValid) {
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
        updateTable(); // Обновляем таблицу
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

async function updateTable() {
    const response = await fetch('');
    const text = await response.text();
    const parser = new DOMParser();
    const doc = parser.parseFromString(text, 'text/html');

    const newTableBody = doc.getElementById('fileTableBody');
    const fileTableBody = document.getElementById('fileTableBody');

    fileTableBody.innerHTML = newTableBody.innerHTML; // Обновляем таблицу
    document.getElementById('fileTable').style.display = 'table';
}

function formReset() {
    validFormArr.forEach((el) => {
        form.reset();
        el.setAttribute("is-valid", 0);
        el.style.border = "none";
    });
}
