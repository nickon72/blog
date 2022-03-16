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
                            <li>Восстановление пароля</li>
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

    <section class="wrapper ">

        <div class="container g-pt-100 g-pb-20">
            <div class="row justify-content-between">
                <div class="col-md-6 col-lg-5 flex-md-unordered align-self-center g-mb-80">
                    <div class="u-shadow-v21 g-bg-white rounded g-pa-50">
                        <header class="text-center mb-4">
                            <h2 class="h2 g-color-black g-font-weight-200"> Восстановление пароля</h2>
                            <h2 class="subtitle">
                                Введите новый пароль.
                            </h2>
                        </header>
            <?= flash(); ?>
            <form action="/password-recovery/change" method="post">
                <input type="hidden" name="selector" value="<?= $data['selector'];?>">
                <input type="hidden" name="token" value="<?= $data['token'];?>">

                <div class="form-group">
                    <input required value="" type="password"  name="password" class="form-control" maxlength="100" data-msg-email="Введите новый пароль"
                           data-msg-required="Введите новый пароль" placeholder="password">
                </div>

                <div class="text-center mb-5">
                    <button class="btn btn-default btn-block" type="submit">Отправить</button>
                </div>
            </form>
                 <p><br></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Login -->

</section>
<!--end wrapper-->