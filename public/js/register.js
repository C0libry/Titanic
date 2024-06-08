const username = document.getElementById("username");
username.addEventListener("change", check_username);

async function check_username() {
    const requestURL = "/is_username_exist?username=" + username.value;
    const options = {
        method: "GET",
        headers: {
            Accept: "application/json",
        },
    };

    try {
        const response = await fetch(requestURL, options);
        const result = await response.json();
        response.status === 200 ? is_invalid(result.data) : is_invalid(true);
        return result;
    } catch (error) {
        console.error(error);
    }
}

function is_invalid(isInvalid) {
    username.className = isInvalid
        ? "form-control block mt-1 w-full is-invalid"
        : "form-control block mt-1 w-full is-valid";
}
