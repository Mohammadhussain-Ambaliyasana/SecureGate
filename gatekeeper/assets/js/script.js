// To prevent form resubmissions

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}


// Number Input

function appendNumber(number) {
    const display = document.getElementById('display');
    if (display.value.length < 6) { // Limit input to 6 digits
        if (display.value === '') {
            display.value = number;
        } else {
            display.value += number;
        }
    }
}

function backspace() {
    const display = document.getElementById('display');
    display.value = display.value.slice(0, -1);
    if (display.value === '') {
        display.value = '';
    }
}
