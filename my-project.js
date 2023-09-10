        const userName = document.getElementById("username");
        const password = document.getElementById("password");
        const retypedPassword = document.getElementById("retypedPass");
        const signUpButton = document.getElementById("signUpButton");

        let userNameValid = false;
        let passwordValid = false;
        let retypedPasswordValid = false;

        function validateButton() {
            if (userNameValid && passwordValid && retypedPasswordValid) {
                signUpButton.removeAttribute("disabled");
                // window.location.href='my-project.html';
            } else {
                signUpButton.setAttribute("disabled", "");
            }
        }

        userName.addEventListener('blur', () => {
            let currentValue = userName.value;
            let numberOfCharacters = currentValue.length;

            if (numberOfCharacters >= 5) {
                userName.classList.remove('error');
                userNameValid = true;
            } else {
                userName.classList.add('error');
                userNameValid = false;
            }
            validateButton();
        });

        password.addEventListener('blur', () => {
            let currentValue = password.value;
            let numberOfCharacters = currentValue.length;
            if (numberOfCharacters >= 6) {
                password.classList.remove('error');
                passwordValid = true;
            } else {
                password.classList.add('error');
                passwordValid = false;
            }
            validateButton();
        });

        retypedPassword.addEventListener('blur', () => {
            if (password.value === retypedPassword.value) {
                retypedPasswordValid = true;
                retypedPassword.classList.remove('error');
            } else {
                retypedPasswordValid = false;
                retypedPassword.classList.add('error');
            }
            validateButton();
        });
