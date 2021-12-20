<?php
    require "db.php";


    $data = $_POST;
    if(isset($data['do_signup']))
    {
        if(trim($data['login'])== '')
        {
            $errors[] = 'Введите логин!'
        }

        if(trim($data['password'])== '')
        {
            $errors[] = 'Введите пароль!'
        }

        if(trim($data['email'])== '')
        {
            $errors[] = 'Введите почту!'
        }

        if(trim($data['password_2'])!= $data['password'])
        {
            $errors[] = 'Пароли не совпадают!'
        }
    }

    if(empty($errors))
    {

    }
    else
    {
        echo '<div style="color: red;">' .array_shift($errors).'</div><hr>';
    }
?>



<form action="/signup.php" method="POST">
    <p>
        <p><strong>Ваш логин</strong>:</P>
        <input type="text" name="login">
    </p>

    <p>
        <p><strong>Ваш пароль</strong>:</p>
        <input type="email" name="email">
    </p>

    <p>
        <p><strong>Ваш пароль</strong>:</p>
        <input type="password" name="password">
    </p>
    
    <p>
        <p><strong>Введите пароль ещё раз</strong></p>
        <input type="password" name="password_2">
    </p>

    <p>
        <button type="sumbit">Зарегистрироваться</button>
    </p>

</form>