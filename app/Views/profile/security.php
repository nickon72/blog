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
                            <li>Профиль</li>
                            <li>Безопасность</li>
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

    <section>
        <div class="container g-pt-100 g-pb-20">
            <div class="row justify-content-between">
                <div class="col-md-6 col-lg-5 flex-md-unordered align-self-center g-mb-80">
                    <div class="u-shadow-v21 g-bg-white rounded g-pa-50">
                        <header class="text-center mb-4">
                            <h2 class="h2 g-color-black g-font-weight-200">Безопасность</h2>
                        </header>
                        <?php echo flash(); ?>
                        <form action="/profile/security" method="post">

                            <label>Текущий пароль</label>
                            <div class="form-group">
                                <input  type="password" name="password" class="form-control">
                            </div>
                            <label>Новый пароль</label>
                            <div class="form-group">
                                <input  type="password" name="new_password" class="form-control"> <br> <br>

                            </div>

                            <div class="text-center mb-5">
                                <button class="btn btn-default btn-block" type="submit">Обновить</button>
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


