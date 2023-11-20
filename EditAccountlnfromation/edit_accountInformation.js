document.addEventListener("DOMContentLoaded", function () {
    const accountInfo = document.getElementById("account-info");
    const errorMessage = document.querySelector(".error-message");
    let isEditable = false;

    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const profileImageInput = document.getElementById('profile-image');

    const saveButton = document.getElementById("save-button");
    const cancelButton = document.getElementById("cancel-button");

    profileImageInput.disabled = true; // ファイル選択ボタンを初期状態で非活性化

    accountInfo.addEventListener("click", function () {
        isEditable = !isEditable;
        usernameInput.readOnly = !isEditable;
        emailInput.readOnly = !isEditable;
        passwordInput.readOnly = !isEditable;
        confirmPasswordInput.readOnly = !isEditable;

        if (isEditable) {
            profileImageInput.removeAttribute('readonly');
            errorMessage.style.display = "none";
            profileImageInput.disabled = false; // ファイル選択ボタンを編集可能時に活性化
        } else {
            profileImageInput.setAttribute('readonly', 'true');
            profileImageInput.disabled = true; // ファイル選択ボタンを非活性化
        }

        this.classList.toggle('active', isEditable);
        this.style.cursor = isEditable ? "default" : "pointer";

        if (isEditable) {
            saveButton.disabled = false;
            cancelButton.style.pointerEvents = "auto";
        } else {
            saveButton.disabled = true;
            cancelButton.style.pointerEvents = "none";
        }
    });

    const formElements = [usernameInput, emailInput, passwordInput, confirmPasswordInput, profileImageInput];

    formElements.forEach(function (element) {
        element.addEventListener("click", function () {
            if (!isEditable) {
                errorMessage.style.display = "block";
            }
        });
    });

    saveButton.addEventListener("click", function () {
        const isAnyFieldEmpty = [usernameInput, emailInput, passwordInput, confirmPasswordInput].some(function (input) {
            return input.value.trim() === '';
        });

        if (isAnyFieldEmpty) {
            alert("いずれかの項目が入力されていません。");
        } else {
            // パスワードの条件チェック
            const password = passwordInput.value.trim();
            if (!password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{5,15}$/)) {
                alert("大文字、小文字、半角英数字を含む、5文字以上15未満で入力してください。");
                return;
            }

            // パスワード確認チェック
            const confirmPassword = confirmPasswordInput.value.trim();
            if (password !== confirmPassword) {
                alert("パスワードが一致しません。");
                return;
            }

            alert("保存しました");
        }
    });

    cancelButton.addEventListener("click", function () {
        // キャンセル処理
        alert("入力内容をキャンセルしました");
        usernameInput.value = ''; 
        emailInput.value = ''; 
        passwordInput.value = ''; 
        confirmPasswordInput.value = '';
        profileImageInput.value = ''; 
        errorMessage.style.display = "none"; 
        profileImageInput.disabled = true; 
    });
});
