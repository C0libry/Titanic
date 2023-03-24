// var socket = new WebSocket("ws://192.168.1.42:8080");

// socket.onopen = function()
// {
//     alert("Соединение установлено.");
// };

// socket.onclose = function(event)
// {
//     if (event.wasClean)
//     {
//         alert('Соединение закрыто чисто');
//     }
//     else
//     {
//         alert('Обрыв соединения'); // например, "убит" процесс сервера
//     }
//     alert('Код: ' + event.code + ' причина: ' + event.reason);
// };

// socket.onmessage = function(event)
// {
//     alert("Получены данные " + event.data);
// };

// socket.onerror = function(error)
// {
//     alert("Ошибка " + error.message);
// };