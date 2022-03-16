<?php $this->layout('\layout') ?>

<?=$script; ?>
<section class="wrapper">
    <section class="page_head">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Вы здесь:</li>
                            <li><a href="/">Главная</a></li>
                            <li>Контакты</li>
                        </ul>
                    </nav>

                    <div class="page_title">
                        <h2>Контакты</h2>
                        <!--<span class="sub_heading">We are here for you 24/7</span>-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact_3">
        <div class="container">
            <div class="row sub_content">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <?php echo flash(); ?>
                    <form id="contactForm" action="/contact" method="post">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-4 ">
                                    <label> Ваше имя (required)</label>
                                    <br>
                                    <input required="" type="text" id="name" name="name" class="form-control" maxlength="100" data-msg-required="Пожалуйста, введите Ваше имя" value="" placeholder="" >
                                </div>
                                <div class="col-lg-4 ">
                                    <label>Ваш Email</label>
                                    <br>
                                    <input required="" type="email" id="email" name="email_user" class="form-control" maxlength="100"  data-msg-required="Пожалуйста, введите Ваш email адрес." value="" placeholder="" >
                                </div>
                                <div class="col-md-4">
                                    <label>Тема</label>
                                    <br>
                                    <input required="" type="text" id="subject" name="title" class="form-control" maxlength="100" data-msg-required="Пожалуйста, введите Тему письма" value="" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Ваше сообщение :</label>
                                    <br>
                                    <textarea required="" id="message" class="form-control" name="body" rows="10" cols="50" data-msg-required="Пожалуйста, введите Ваше сообщение" maxlength="5000" placeholder=""></textarea>

                                </div>
                            </div>
                        </div>
                        <? echo $captcha; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" data-loading-text="Loading..." class="btn btn-default btn-lg" value="Отправить">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="sidebar">
                        <div class="widget_info">
                            <div class="dividerHeading">
                                <h4><span>Пишите:</span></h4>
                            </div>
                            <p>Буду рад услышать ваши отзывы и пожелания. </p>
                            <ul class="widget_info_contact clearfix">
                                <li class="col-md-4"><i class="fa fa-map-marker"></i><strong>Адрес</strong> <p> Украина, Кропивницкий</p></li>
                                <li class="col-md-4"><i class="fa fa-envelope"></i> <strong>Email</strong><p> <a href="#">admin@sintezmlm.ru</a></li>
                                <li class="col-md-4"><i class="fa fa-phone"></i> <strong>Телефон</strong> <p> :---</p></li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</section>
<!--end wrapper-->