





<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Hackerzzzz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/cover/">


    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">

    <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">
    <link rel="stylesheet" href="cover.css">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        input {
            opacity: 0.7;
        }
    </style>


    <link href="cover.css" rel="stylesheet">
</head>
<?php
if(isset($_GET['login'])){
    $login=$_GET['login'];
    if($login=="false"){
        echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="height:74px;">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              Warnign !
              <strong>Password Incorrect !<br> Try Again</strong> 
            </div>
        ';
    }
}
?>
<body class="text-center">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">HacKorZee</h3>
                <nav class="nav nav-masthead justify-content-center">

                    <a class="nav-link active" href="#">Home</a>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#loginmodal">Log In</a>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#About">About developer</a>
                </nav>
            </div>
        </header>


        <!--signup Modal -->
        <div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-left" style="background: linear-gradient(#4e004e,black,#330933);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="signup.php" method="POST">

                            <div class="form-group">
                                <label for="" class="text-left">Name (Full Name)</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                                    name="name">
                            </div>

                            <div class="form-group">
                                <label for="" class="text-left">Email</label>
                                <input type="email" class="form-control" id="useremail" aria-describedby="emailHelp"
                                    name="useremail">
                           

                            </div>

                            <div class="form-group">
                                <label for="" class="text-left">Username</label>
                                <input type="text" class="form-control" id="signupusername" aria-describedby="emailHelp"
                                    name="signupusername" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="signuppassword" name="signuppassword">
                                
                            </div required>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword">
                            </div required>


                            <small id="emailHelp" class="form-text text-muted">All credentials are kept private</small>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your Details with
                                anyone </small>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-primary">Sign Up</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>


        <!--log in Modal -->
        <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-left" style="background:linear-gradient(black,#330933);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="" class="text-left">Username</label>
                                <input type="text" class="form-control" id="loginusername" aria-describedby="emailHelp"
                                    name="loginusername">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your Username with
                                    anyone else.</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="loginpassword" name="loginpassword">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-primary">Log In</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        <!--About developer modal -->
        <div class="modal fade" id="About" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content" style="background:linear-gradient(black,#330933);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">About Developer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card" style="width: 18rem; margin: auto;" >
                            <div class="card-body" style="background:linear-gradient(black,#330933);">
                              <h5 class="card-title">Naman Kumar</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Computer Science Student</h6>
                              <p class="card-text">BTECH (hons) CSE <br> Cyber Security</p>
                
                            </div>
                          </div>
                          <br>
                        <div class="card" style="width: 18rem; margin: auto;" >
                            <div class="card-body" style="background:linear-gradient(black,#330933);">
                              <h5 class="card-title">Ujjwal Dhiman</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Computer Science Student</h6>
                              <p class="card-text">BTECH (hons) CSE <br> AI-ML</p>
                
                            </div>
                          </div>

                    </div>

                </div>
            </div>
        </div>


        <!-- body starts from here  -->
        <main role="main" class="inner cover">
            <h1 class="cover-heading">HacKorZee</h1>
            <p class="lead"></p>
            <p>Real time Monitoring platform to Monitor students in Hackathons</p>
            <p>A online platform to conduct Hackathon virtually</p>
            <p class="lead">
                <a href="#" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#signupmodal">Sign
                    Up</a>
            </p>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">

              
            </div>
        </footer>
    </div>
    <!-- body ends here -->




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
<script>
    $(function () {
  $('[data-toggle="popover"]').popover()
})
</script>

</body>

</html>