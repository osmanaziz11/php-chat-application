<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome - Malatist</title>
    <!-- Favicon  -->
    <link rel="shortcut icon" href="assects\media\favicon.png" type="image/jpg" />
    <!-- Index.css  -->
    <link rel="stylesheet" href="assects\css\global.css" />
    <!-- Bootstrap CDN  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet" />
    <!-- Font Awesome  -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <div id="main_container" class="container-fluid  my-5 shadow rounded">

        <div class="row">
            <div class="col-12">
                <h1 class="text-center pt-3">Create Account</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <form class="d-flex flex-column justify-content-center align-items-center">

                    <input type="text" placeholder="First name" name="name" id="name" required class="my-3 p-2" />

                    <input type="text" placeholder="Email or Username" name="email" id="email" required
                        class="mb-3 p-2" />

                    <input type="password" placeholder="Password" name="password" id="password" required
                        class="mb-3 p-2" />

                    <input type="phone" placeholder="Phone" name="phone" id="phone" required class=" p-2" />

                    <h6 class="text-center"><button class="mt-5 p-3">Create Account</button></h6>
                    <div class="social p-4 justify-content-center align-items-center">
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <p class="text-center">Powered by Data Nomad</p>
            </div>
        </div>
    </div>
    <script src="assects/Js/jquery.js"></script>
    <!-- Custom Script  -->
    <script>
    // Event Trigger: When Login Form Submit 
    $('form').submit(function(event) {
        event.preventDefault();
        const formData = new FormData(this); // Fetching Form Data
        var object = {};
        formData.forEach(function(value, key) {
            object[key] = value;
        });
        var json = JSON.stringify(object);
        console.log(json);
        fetch('server/api/register.php', {
                'method': 'post',
                'body': json,
            }).then(response => response.json())
            .then(res => {
                if (res.status == 1) {
                    $('#main_container').removeClass('shadow');
                    $('#main_container').addClass('valid-error');
                    setTimeout(() => {
                        window.location.href = 'http://localhost:81/Malatist/login.php';
                    }, 2000)
                } else {
                    $('#main_container').removeClass('shadow');
                    $('#main_container').addClass('invalid-error');
                    setTimeout(() => {
                        $('#main_container').addClass('shadow');
                        $('#main_container').removeClass('invalid-error');
                    }, 2000)
                }
            });

    });
    </script>
</body>

</html>