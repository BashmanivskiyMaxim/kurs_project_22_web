<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="/main"><img src="/images/style/computer.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                        UPwork</a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php session_start();
                        if(!isset($_SESSION['email'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/user/login">Увійти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/user/register">Зареєструватися</a>
                        </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/account" aria-current="page"><?=$_SESSION['email'] ?></a>
                            </li>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Створити:
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="/resume/add">Резюме</a></li>
                                    <li><a class="dropdown-item" href="/vacancy/add">Вакансію</a></li>
                                </ul>
                            </div>
                        <?php endif; ?>

                    </ul>
                    <div class="d-flex">
                        <ul class="navbar-nav nav-tabs mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/vacancy/index?page=1">шукачу роботи</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/resume/index?page=1">роботодавцю</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
    </header>
<div class="container">
    <main>
        <?php include 'application/views/'.$content_view; ?>
    </main>
</div>
<footer style="" class="footer bg-dark fixed-bottom">
    <div class="text-light text-center">
        &copy;UPwork
    </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
