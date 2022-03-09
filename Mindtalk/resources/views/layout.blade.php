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
			background-image: url('sitePics/background-image.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            /*background-color:rgb(31, 41, 3);*/ 
            background-size: 100% 100%;
			display:grid;
            grid-template-columns:auto 400px auto;
           	grid-template-rows:20% 465px;
            grid-row-gap:5px;
            grid-template-areas:
                                ". t ."
                                ". m ."
		}

		.top{
			grid-area:t;
		}

		.main{
			background-color: rgb(234, 245, 255);
			grid-area:m;
				
			border:2px solid lightgrey;
            border-radius:15px;

			padding-top: 10px;
		}

		text{
			font-size:20px;
		}

		input[type=text], input[type=password], input[type=email], select {
        	width: 80%;
        	padding: 8px 10px;
        	display: inline-block;
        	border: 1px solid #ccc;
        	border-radius: 4px;
        	box-sizing: border-box;
        }

		button[type=submit]{
            background-color:#900C3F /*#4267B2*/;
            border: none;
            color: white;
            padding: 15px 137px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius:15px;
		}
    </style>

</head>
<body style="@yield('main-style')">
    <div class="nav">

    </div>

    <div class="main">
        @yield('content')
    </div>
</body>
</html>