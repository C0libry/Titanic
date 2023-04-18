let socket = new WebSocket("ws://192.168.1.42:8080");

socket.onopen = function () {
    console.log("Соединение установлено.");
};

socket.onclose = function (event) {
    if (event.wasClean) {
        alert('Соединение закрыто чисто');
    }
    else {
        alert('Обрыв соединения');
    }
    alert('Код: ' + event.code + ' причина: ' + event.reason);
};

socket.onmessage = function (event) {
    //alert("Получены данные " + event.data);
    sleep(100); // Задержка, чтобы данные в базе данных успели обновится
    let requestURL = href;
    let request = new XMLHttpRequest();

    request.open('Get', requestURL, true);
    request.onload = () => {
        let out = request.response;
        let elem = document.createElement('div');
        elem.innerHTML = out;
        elem = elem.getElementsByClassName('chat-history')[0];
        chat_history.parentNode.replaceChild(elem, chat_history);
        chat_history = document.querySelector('.chat-history');
    }
    request.send();
};

socket.onerror = function (error) {
    alert("Ошибка " + error.message);
};


let chat_history = document.querySelector('.chat-history');
let href = window.location.pathname;
let form = document.getElementById('chatForm');
form.addEventListener('submit', sub);

function sub(event) {
    event.preventDefault();

    let requestURL = href;
    let formData = new FormData(form);
    let request = new XMLHttpRequest();
    request.open('Post', requestURL, true);
    request.onload = () => {
        let out = request.response;
        let elem = document.createElement('div');
        elem.innerHTML = out;
        elem = elem.getElementsByClassName('chat-history')[0];
        chat_history.parentNode.replaceChild(elem, chat_history);
        chat_history = document.querySelector('.chat-history');
    }
    request.send(formData);
    // addMyMessage(formData.get('user_message'));
    socket.send(formData.get('user_message'));
    event.target.reset();
}

function sleep(millis) {
    var t = (new Date()).getTime();
    var i = 0;
    while (((new Date()).getTime() - t) < millis) {
        i++;
    }
}