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
                            <li> Переотправка письма с подтверждением почты.</li>
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
    <section class="wrapper ">

        <div class="container g-pt-100 g-pb-20">
            <div class="row justify-content-between">
                <div class="col-md-6 col-lg-5 flex-md-unordered align-self-center g-mb-80">
                    <div class="u-shadow-v21 g-bg-white rounded g-pa-50">
                        <header class="text-center mb-4">
                            <h2 class="h2 g-color-black g-font-weight-200"> Переотправка письма с подтверждением почты.</h2>
                            <h2 class="subtitle">
                                Письмо придет вам на почту.
                            </h2>
                        </header>
                        <?php echo flash(); ?>
                        <!-- Form -->
                        <form method="post" action="/resend_email">

                            <div class="form-group">
                                <input required value="" type="email"  name="email" id="email" class="form-control" maxlength="100" data-msg-email="Введите Ваш email"
                                       data-msg-required="Введите Ваш email" placeholder="Email">

                            </div>


                            <div class="text-center mb-5">
                                <button class="btn btn-default btn-block" type="submit">Отправить</button>
                            </div>

                        </form>
                        <!-- End Form -->

                        <footer class="text-center">
                            <p class="g-color-gray-dark-v5 mb-0">Нет аккаунта? <b><a class="g-font-weight-600" href="/register">Регистрация</a></b></p>
                            <p class="g-color-gray-dark-v5 mb-0">Забыли пароль? <b><a class="g-font-weight-600" href="/password-recovery">Восстановление пароля</a></b></p>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Login -->

</section>
<!--end wrapper-->



