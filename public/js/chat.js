let socket = new WebSocket("ws://172.22.28.63:8080");

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
    console.log("Ошибка " + error.message);
};


let chat_history = document.querySelector('.chat-history');
let href = window.location.pathname;
let form = document.getElementById('chatForm');
form.addEventListener('submit', sub);

let btn = document.getElementById("show_menu");
btn.addEventListener("click", show_menu);

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
        socket.send(formData.get('user_message'));
    }
    request.send(formData);
    event.target.reset();
}

function sleep(millis) {
    var t = (new Date()).getTime();
    var i = 0;
    while (((new Date()).getTime() - t) < millis) {
        i++;
    }
}

function show_menu() {
    let plist = document.getElementById("plist");
    if (plist.getAttribute('class') == 'people-list-open')
        plist.className = 'people-list';
    else
        plist.className = 'people-list-open';
    // console.log(plist.getAttribute('class'));
}
