document.addEventListener("DOMContentLoaded", function () {
    const registerBtn = document.getElementById("register-btn");

    registerBtn.addEventListener("click", function () {
        const emailInput = document.getElementById('login-email');
        const usernameInput = document.getElementById('login-name');
        const passwordInput = document.getElementById('login-pass');
        const confirmPasswordInput = document.getElementById('confirm-pass');

        const isAnyFieldEmpty = [usernameInput, emailInput, passwordInput, confirmPasswordInput].some(function (input) {
            return input.value.trim() === '';
        });

        if (isAnyFieldEmpty) {
            alert("いずれかの項目が入力されていません。");
        } else if (passwordInput.value !== confirmPasswordInput.value) {
            alert("パスワードと一致しません。");
        } else {
            alert("保存しました");
        }
    });
});
