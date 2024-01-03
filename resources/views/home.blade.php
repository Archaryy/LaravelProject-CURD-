<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Project</title>
</head>
<body>

    @auth
    <p>
        Congrats you are logged in!
    </p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>
        
    @else
        <h1>
            Testing
        </h1>
        <div class="register" style="border: 3px solid black">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input name= "name" type="text" placeholder="name">
                <input name= "email" type="text" placeholder="email">
                <input name= "password" type="password" placeholder="password">
                <button>Register</button>
            </form>
        </div>
        <div class="login" style="border: 3px solid black">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input name= "loginname" type="text" placeholder="name">
                <input name= "loginpassword" type="password" placeholder="password">
                <button>Log in</button>
            </form>
        </div>
    @endauth


</body>
</html>