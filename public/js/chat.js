let socket = new WebSocket("ws://192.168.1.42:8080");
let chat_history = document.querySelector('.chat-history');
let href = window.location.pathname;
let form = document.getElementById('chatForm');
let btn = document.getElementById("show_menu");

btn.addEventListener("click", show_menu);
form.addEventListener('submit', send_message);
chat_history.scrollTop = chat_history.scrollHeight;

socket.onopen = function () {
    console.log("Соединение установлено.");
};

socket.onclose = function (event) {
    if (event.wasClean) {
        console.log('Соединение закрыто чисто');
    }
    else {
        console.log('Обрыв соединения');
    }
    console.log('Код: ' + event.code + ' причина: ' + event.reason);
};

socket.onmessage = function (event) {
    //alert("Получены данные " + event.data);
    get_chat_history();
};

socket.onerror = function (error) {
    console.log("Ошибка " + error.message);
};

async function get_chat_history() {
    const requestURL = href;
    const options = {
        method: 'GET',
    };

    try {
        const response = await fetch(requestURL, options);
        const result = await response.text();
        update_chat_history(result);
        return result;
    } catch (error) {
        console.error(error);
    }
}

async function send_message(event) {
    event.preventDefault();
    let formData = new FormData(form);
    const requestURL = href;
    const options = {
        method: 'POST',
        body: formData,
    };

    try {
        const response = await fetch(requestURL, options);
        const result = await response.text();
        update_chat_history(result);
        if (socket['readyState'] === 1) socket.send(formData.get('user_message'));
        event.target.reset();
        console.log('fetch');
        return result;
    } catch (error) {
        console.error(error);
    }
}

function update_chat_history(out) {
    let elem = document.createElement('div');
    elem.innerHTML = out;
    elem = elem.getElementsByClassName('chat-history')[0];
    chat_history.parentNode.replaceChild(elem, chat_history);
    chat_history = document.querySelector('.chat-history');
    chat_history.scrollTop = chat_history.scrollHeight;
}

function show_menu() {
    let plist = document.getElementById("plist");
    if (plist.getAttribute('class') === 'people-list-open')
        plist.className = 'people-list';
    else
        plist.className = 'people-list-open';
}