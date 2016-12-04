<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RELIANCE PAINTS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {


                background-color: #fff;
                color:   #000000;
               font-style: "Impact, Charcoal, sans-serif";
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color:  #000000;
                padding: 0 25px;
                font-size: 15px;
                font-weight: 800;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }


.button {
    background-color: #FFA500; /* Green */
    border: none;
    color: white;
    padding: 32px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}


.button:hover {
    background-color: #FFA500; /* Green */
    color: white;
}


            body {
           background-image: url('assets/B3.jpg');

}
        </style>
    </head>
    <body>


        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}" class="button" >Login</a>
                    <a href="{{ url('/register') }}" class="button">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" align= "justify">
                
                </div>

                <div class="links">
                  
                </div>
            </div>
        </div>
    </body>
</html>
