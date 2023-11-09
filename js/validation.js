const validation = new JustValidate('#signup');

validation
    .addField('#name',[
        {
            rule:"required"
        }
    ])

    .addField('#email',[
        {
            rule:"required"
        }
    ])

    .addField('#password',[
        {
            rule:"required"
        },

        {
            rule:"password"
        }
    ])

    .addField('#password_confirmation',[
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },

            errorMessage: "Your Password Should Match"
        }
    ])

        .onSuccess((event) => {

            document.getElementById("signup").submit();
        });