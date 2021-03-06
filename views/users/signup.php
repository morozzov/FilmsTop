<head>
    <link href="/public/vendors/bootstrap502/css/signup.css" rel="stylesheet">
</head>

<script>
    $(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();
            if ($("#name").val() != "" && $("#login").val() != "" && $("#password1").val() != "" && $("#password2").val() != "") {
                if ($("#password1").val() == $("#password2").val()) {
                    $.ajax({
                        type: 'post',
                        url: '/users/addNew',
                        data: $('form').serialize()
                        ,
                        success: function (data) {
                            if (data == 'success') {
                                window.location = '/films/getall'
                            } else {
                                alert("Login or password not right")
                            }
                        }
                    });
                } else {
                    alert("Passwords are not equal")
                }
            } else {
                alert("Enter all data")
            }
        });

    });
</script>

<form method="post" action="/users/addNew">

    <h1 class="h3 mb-3 fw-normal">Sign up</h1>

    <div class="form-floating mb-1">
        <input name="name" id="name" type="text" class="form-control" placeholder="name">
        <label name="name" for="floatingInput">Name</label>
    </div>
    <div class="form-floating mb-1">
        <input name="login" id="login" type="email" class="form-control" placeholder="login">
        <label name="login" for="floatingInput">Email</label>
    </div>
    <div class="form-floating mb-1">
        <input name="password1" id="password1" type="password" class="form-control" placeholder="Password">
        <label name="password" for="floatingPassword">Password</label>
    </div>
    <div class="form-floating mb-3">
        <input name="password2" id="password2" type="password" class="form-control" placeholder="Password">
        <label name="password" for="floatingPassword">Password again</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-1" type="submit">Sign up</button>
    <a href="/users/signin">
        <button class="w-100 btn btn-lg btn-outline-danger mb-1" type="button">Cancel</button>
    </a>
</form>
