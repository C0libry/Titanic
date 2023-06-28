const username = document.getElementById('username');
username.addEventListener('blur', check_username);

async function check_username() {
    const requestURL = '/check_username/' + username.value;
    const options = {
        method: 'GET',
    };

    try {
        const response = await fetch(requestURL, options);
        const result = await response.text();
        if (response.status === 200) change_tags(result);
        return result;
    } catch (error) {
        console.error(error);
    }
}

function change_tags(response) {
    let elem = document.getElementById('username_check');

    if (response == 1) {
        elem.textContent = 'Логин свободен';
        elem.className = 'ok';
    } else {
        elem.textContent = 'Логин занят';
        elem.className = 'errors';
    }
}