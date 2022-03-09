<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <style>
        html, body{
            width:100%;
            height:100%;
            margin:0px auto;
            text-align: center;
            font-family:  'Trebuchet MS', sans-serif;
        }

        body{
            background-image: url('/Mindtalk/public/sitePics/background-image.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            display:grid;
            grid-template-columns:auto 800px auto;
            grid-template-rows:20px 65px auto;
            grid-row-gap:0px;
            grid-template-areas:
                                ". l ."
                                ". n ."
                                ". m ."
        }

        .log{
            /*background-color: red;*/
            color: white;
            grid-area:l;
        }

        .nav{
            grid-area:n;
            /*background-color: #900C3F;*/
            padding-top: 15px;

            border:2px transparent;
            border-radius:15px;
        }

        .main{
            grid-area:m;
            background-color: rgb(234, 245, 255);

            border:2px solid lightgrey;
            border-radius:15px;

            padding-top: 10px;
        }

        a:link, a:visited {
              background-color: #900C3F;
            /*#f44336*/ 
              color: white;
              padding: 14px 40px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
        }

        .reset-all{
            all: revert;
        }
    </style>
</head>
<body>
    <div class="log">
        You are currently logged in as <?php
                                            if($data != null){
                                                echo "".$data->username;
                                            }else {
                                                echo "a guest";
                                            }
                                        ?>		
    </div>

    <div class="nav">
        <a href=" {{ route('homepage') }} ">Home</a>
        <?php
            if($data != null){
                echo "<a href=\"/Mindtalk/public/myProfile/0\">Profile</a>";
                //echo "<a href=\"".route('profilePage')."\">Profile</a>";
            }else {
                echo "<a href=\"".route('loginPage')."\">Login</a>";
            }
        ?>
        <a href="/Mindtalk/public/searchPost/0">Search posts</a>
        <a href=" {{ route('contactPage') }} ">Contact us</a>
        <?php
            if($data != null){
                echo "<a href=\"".route('logout')."\">Log out</a>";
            }else {
                echo "<a href=\"".route('registrationPage')."\">Register</a>";
            }
        ?>	
    </div>

    <div class="main">
        <br>
        @yield('content')
    </div>
</body>
</html>