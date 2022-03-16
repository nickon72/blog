<!--Start Header-->
<header id="header">


    <div id="logo-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div id="logo">
                        <h1><a href="/"><img src="/img/logo.png"/></a></h1>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8">
                    <!-- Navigation
                    ================================================== -->
                    <div class="navbar navbar-default navbar-static-top" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="/">Главная</a>
                                </li>



                                <li><a href="/blog">Блог</a>
                                </li>

                                <li><a href="#">Каталог курсов</a>
                                    <ul class="dropdown-menu">
                                       <?=menu();?>
                                    </ul>
                                </li>

                                <li><a href="/contact">Контакты</a>

                                </li>
                                <li>
                                    &emsp;&emsp;&emsp;
                                </li>
                                <?php if(auth()->isLoggedIn()) :?>
                                    <li><a href="#" class="fa fa-user">&emsp;<?= auth()->getUsername()?></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/profile/info">Основная информация</a></li>
                                            <li><a href="/profile/security">Безопасность</a></li>
                                            <li><a href="/logout">Выйти</a></li>

                                        </ul>
                                    </li>

                                <?php else: ?>
                                <li><a href="#" class="fa fa-user">&emsp;Профиль</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/login">Войти</a></li>
                                        <li><a href="/register">Зарегистрироваться</a></li>
                                    </ul>
                                </li>
                                <?php endif;?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.container -->
    </div>
    <!--/#logo-bar -->
</header>
<!--End Header-->



