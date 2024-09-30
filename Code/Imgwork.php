<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .container{
            position: relative;
            width: 100%;
            min-height: 100vh;
        }
        .container .container-image{
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: center;
            gap: 15px;
        }
        .container .container-image .image{
            height: 250px;
            width: 250px;
            cursor: pointer;
        }
        .container .container-image .image img{
            height: 100%;
            width: 100%;
        }
        .container .container-image .image:hover img{
            transform: scale(1.1);
        }
        .popup-image{
            position: fixed;
            display: none;
            background: rgba(0,0,0,0.9);
            top: 0; left: 0;
            height: 100%;
            width: 100%;
            z-index: 100;
        }
        .popup-image span{
            position: absolute;
            top: 0; left: 0;
            z-index: 100;
            cursor: pointer;
            font-size: 60px;
            color: #FFF;
        }
        .popup-image img{
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%,-50%);
            z-index: 100;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container-image">
            <div class="image"><img src="IMG/Post/0001-104.jpg" alt=""></div>
            <div class="image"><img src="IMG/Post/294488644_577989800645207_2228572846989360740_n.jpg" alt=""></div>
            <div class="image"><img src="IMG/Post/0001-104.jpg" alt=""></div>
            <div class="image"><img src="IMG/Post/0001-104.jpg" alt=""></div>
            <div class="image"><img src="IMG/Post/0001-104.jpg" alt=""></div>
        </div>
    </div>

    <div class="popup-image">
        <span>&times;</span>
        <img src="IMG/Post/0001-104.jpg" alt="">
    </div>

    <script>
        document.querySelectorAll('.container-image img').forEach(image => {
            image.onclick = () => {
                document.querySelector('.popup-image').style.display = 'block';
                document.querySelector('.popup-image img').src = image.getAttribute("src");
            }
        });
        document.querySelector('.popup-image span').onclick = () => {
            document.querySelector('.popup-image').style.display = "none";
        }
    </script>
</body>
</html
