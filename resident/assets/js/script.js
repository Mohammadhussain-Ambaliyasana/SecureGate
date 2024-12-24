// To prevent form resubmissions

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

// document.getElementById('generateBtn').addEventListener('click', function() {
//     const code = generateRandomCode(6);
//     document.getElementById('codeDisplay').innerText = code;
// });

// function generateRandomCode(length) {
//     const characters = '0123456789';
//     let result = '';
//     for (let i = 0; i < length; i++) {
//         result += characters.charAt(Math.floor(Math.random() * characters.length));
//     }
//     return result;
// }