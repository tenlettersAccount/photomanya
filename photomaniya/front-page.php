<?php get_header();

?>
    <section class="wrapper">
        <?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		//
		// Post Content here
		//
	} // end while
} // end if
?>
            <?php
	get_template_part( 'content', 'none' );
         
?>
                <div class="block1">
                    <div class="social inline">
                        <p> &nbsp; </p>
                        <!-- VK Widget -->
                        <div id="vk_groups"></div>
                        <script type="text/javascript">
                            VK.Widgets.Group("vk_groups", {
                                redesign: 1
                                , mode: 3
                                , width: "240"
                                , height: "272"
                                , color1: 'FFFFFF'
                                , color2: '000000'
                                , color3: '5E81A8'
                            }, 20003922);
                        </script>
                    </div>
                    <div class="slide inline"> </div>
                    <div class="button"> <img src="<? bloginfo(stylesheet_directory) ?>/images/arr_l.png" alt="">
                        <button class="button_buy" id="button_make_order">Сделать онлайн-заказ</button> <img src="<? bloginfo(stylesheet_directory) ?>/images/arr_r.png" alt=""> </div>
                    <!-- Trigger/Open The Modal -->
                    <!-- The Modal -->
                    <div id="contact-form-box" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content2">
                            <form action="form-test.php" method="post">
                                <input type="text" placeholder="Ваше имя" id="user_name" name="user_name" class="form-input">
                                <input type="text" placeholder="Ваш e-mail" id="user_email" name="user_email" class="form-input">
                                <input type="text" placeholder="Ваш номер телефона" id="user_tel" name="user_tel" class="form-input">
                                <input type="hidden" id="postId" postId="<?= get_the_ID(); ?>" adminEmail="<?= get_userdata(1)->user_email?>">
                                <p id="err"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:red;"></i> Введите корректные данные</p>
                                <p id="ok">Ваш заказ успешно отправлен!</p>
                                <button id="sendData">Отправить</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="block2">
                    <div class="slogan_block2">
                        <h2>Примеры наших работ</h2> </div>
                    <div class="projects">
                        <div class="swiper-container">
                            <?php if (have_posts()) : ?>
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <?php while (have_posts()) : the_post(); ?>
                                        <?
                                        $cat_name = get_the_category();
                                        if($cat_name[0]->cat_name != "Без рубрики"){
                                           ?>
                                            <div class="project swiper-slide">
                                                <div class="project_img">
                                                    <?= get_the_post_thumbnail($page->ID, 'thumbnail'); ?>
                                                </div>
                                                <br>
                                                <div class="project_text">
                                                    <a href="<?php the_permalink() ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <?
                                        }
                                       ?>
                                                <?php endwhile; ?>
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                <?
                                /*
                                *   Определение мобильного устройства для адаптивного отображения swipera
                                */
                                $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                                $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
                                $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
                                $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
                                $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
                                $mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
                                $symb = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
                                $operam = strpos($_SERVER['HTTP_USER_AGENT'],"Opera M");
                                $htc = strpos($_SERVER['HTTP_USER_AGENT'],"HTC_");
                                $fennec = strpos($_SERVER['HTTP_USER_AGENT'],"Fennec/");
                                $winphone = strpos($_SERVER['HTTP_USER_AGENT'],"WindowsPhone");
                                $wp7 = strpos($_SERVER['HTTP_USER_AGENT'],"WP7");
                                $wp8 = strpos($_SERVER['HTTP_USER_AGENT'],"WP8");
                                if ($ipad || $iphone || $android || $palmpre || $ipod || $berry || $mobile || $symb || $operam || $htc || $fennec || $winphone || $wp7 || $wp8 === true) {
                                    echo "<script>
                                            var swiper = new Swiper('.swiper-container', {
                                                slidesPerView: 'auto'
                                                , height: 122
                                                , slidesPerView: 2
                                                , slidesPerColumn: 1
                                                , paginationClickable: true
                                                , spaceBetween: 30
                                                , nextButton: '.swiper-button-next'
                                                , prevButton: '.swiper-button-prev'
                                                //mobile
                                            });
                                        </script";
                                }else{
                                    echo "<script>
                                            var swiper = new Swiper('.swiper-container', {
                                                slidesPerView: 'auto'
                                                , width: 370
                                                , height: 122
                                                , slidesPerView: 2
                                                , slidesPerColumn: 1
                                                , paginationClickable: true
                                                , spaceBetween: 30
                                                , nextButton: '.swiper-button-next'
                                                , prevButton: '.swiper-button-prev'
                                                //pc
                                            });
                                        </script>";
                                }
                                ?>
                                    <!-- Slider main container -->
                                    <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="block3">
                    <h2>Отзывы</h2>
                    <div class="comment_block comment_block1 inline">
                        <div class="comment_icon"> <img src="<? bloginfo(stylesheet_directory) ?>/images/commennt_icon.jpg" alt=""> </div>
                        <div class="comment">
                            <p> Заказывала кружку. Сама кружка получилась идеальной, быстро изготовили! Мне все понравилось. Ребята молодцы. Большое спасибо! </p>
                        </div>
                        <div class="comment_name">
                            <div class="circle inline vm"> </div>
                            <div class="user_info inline vm">
                                <div class="user_name">Елена</div>
                                <div class="user_city">г. Рязань</div>
                            </div>
                        </div>
                    </div>
                    <div class="comment_block inline">
                        <div class="comment_icon"> <img src="<? bloginfo(stylesheet_directory) ?>/images/commennt_icon.jpg" alt=""> </div>
                        <div class="comment">
                            <p> Придумала сложный вариант виниловой наклейки, позвонил оператор и принял заказ буквально за минутку, профессионалы работают! Спасибо за оперативность! </p>
                        </div>
                        <div class="comment_name">
                            <div class="circle inline vm"> </div>
                            <div class="user_info inline vm">
                                <div class="user_name">Александра</div>
                                <div class="user_city">г. Рязань</div>
                            </div>
                        </div>
                    </div>
                    <div class="comment_block inline">
                        <div class="comment_icon"> <img src="<? bloginfo(stylesheet_directory) ?>/images/commennt_icon.jpg" alt=""> </div>
                        <div class="comment">
                            <p> Придумала сложный вариант виниловой наклейки, позвонил оператор и принял заказ буквально за минутку, профессионалы работают! </p>
                        </div>
                        <div class="comment_name">
                            <div class="circle inline vm"> </div>
                            <div class="user_info inline vm">
                                <div class="user_name">Екатирина</div>
                                <div class="user_city">г. Рязань</div>
                            </div>
                        </div>
                    </div>
                    <div class="comment_func">
                        <div class="send_comment inline"> <a href="">Оставить отзыв</a> </div>
                        <div class="other_comment inline"> <a href="">Смотреть все отзывы</a> </div>
                    </div>
                </div>
    </section>
    <?php get_footer() ?>