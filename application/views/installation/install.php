<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Installation</title>
</head>
<body>
<div class="container">
<h1>Step #1:</h1>
<p>Type your username and password:</p>
<form action="/api/install" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="pass" placeholder="Password" required>
    <hr>
    <input type="submit" value="Next">
</form>
</div>

<style>
body {
    font-family: Arial, Helvetica, sans-serif; 
    color: rgba(0,0,0,0.85);
}
h1 {
    font-size: 1.5rem;
}
    .container {
        border: 1px solid lightgrey;
        width: 50%;
        padding: 30px;
        box-shadow: 0px 0px 3px #888888;
        margin: 0 auto;
        border-radius: 5px;
    }
    p {
        margin-bottom: 35px;
    }
    form input {
        display: block;
        height: 1.2rem;
        width: 100%;
        margin: 10px auto;
        padding: 4px;
        border-radius: 5px;
    border: 1px solid lightgrey;
    }
    hr {
        margin: 25px 0;
        width: 100%;
        height: 1px;
        border: 0;
        background:linear-gradient(to right, #ccc, #333, #ccc);
    }
    form input[type=submit] {
        width: 150px;
        height: 35px;


        margin-left: 0;
        cursor: pointer;
        border: 1px solid gray;

    }
</style>
</body>
</html>
