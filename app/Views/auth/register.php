<?php $this->layout('layout') ?>

<section class="wrapper">
    <section class="page_head">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Вы здесь:</li>
                            <li><a href="/">Главная</a></li>
                            <li>Регистрация</li>
                        </ul>
                    </nav>

                    <div class="page_title">
                        <h2>Профиль</h2>
                        <!--<span class="sub_heading">We are here for you 24/7</span>-->
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Login -->
<section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll loaded dzsprx-readyall" data-options="{direction: 'reverse', settings_mode_oneelement_max_offset: '150'}">
    <!-- Parallax Image -->
    <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-size-cover g-bg-bluegray-opacity-0_3--after" style="height: 140%; background-image: url("/img/deer1.jpg"); background-position-y: -300px;"></div>
    <!-- End Parallax Image -->

    <div class="container g-pt-100 g-pb-20">
        <div class="row justify-content-between">
            <div class="col-md-6 col-lg-5 flex-md-unordered align-self-center g-mb-80">
                <div class="u-shadow-v21 g-bg-white rounded g-pa-50">
                    <header class="text-center mb-4">
                        <h2 class="h2 g-color-black g-font-weight-600">Регистрация</h2>
                    </header>
                    <?php echo flash(); ?>
                    <!-- Form -->
                    <form class="g-py-15" method="POST" action="/register">

                        <div class="form-group   g-mb-20">
                            <input required value="" name="email" id="inputGroup5_1" class="form-control form-control-md g-brd-primary--hover rounded g-py-15 g-px-15" type="email" placeholder="email">
                        </div>

                        <div class="form-group   g-mb-20">
                            <input required value="" name="username" id="inputGroup5_1" class="form-control form-control-md g-brd-primary--hover rounded g-py-15 g-px-15" type="text" placeholder="Ваше имя">
                        </div>

                        <div class="form-group   g-mb-20">
                            <input required name="password" value="" id="inputGroup5_1" class="form-control form-control-md g-brd-primary--hover rounded g-py-15 g-px-15" type="password" placeholder="Пароль">
                        </div>

                        <div class="form-group   g-mb-20">
                            <input required name="password_confirmation" id="inputGroup5_1" class="form-control form-control-md g-brd-primary--hover rounded g-py-15 g-px-15" type="password" placeholder="Подтверждение пароля">
                        </div>
                        <div class="form-group" g-mb-20>
                            <div>
                                <label class="checkbox">
                                    <input type="checkbox" name="terms">
                                    Я согласен с <a href="#">правилами сайта</a>
                                </label>
                            </div>
                        </div>

                        <div class="text-center mb-5">
                            <button class="btn btn-default btn-block" type="submit">Зарегистрироваться</button>
                        </div>
                    </form>
                    <!-- End Form -->

                    <footer class="text-center">
                        <p class="g-color-gray-dark-v5 mb-0">Уже зарегистрированны? <a class="g-font-weight-600" href="/login">Войти</a>
                        </p>

                    </footer>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Login -->