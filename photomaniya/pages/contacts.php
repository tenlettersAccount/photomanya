<?
    $plugin_path_json_file = '../../../../wp-content/plugins/ten_edit/contacts/contactsData.json';
    $contactsJsonData = json_decode(file_get_contents($plugin_path_json_file, JSON_UNESCAPED_UNICODE));
    $tel = $contactsJsonData->tel;
    $city = $contactsJsonData->city;
    $addr = $contactsJsonData->addr;
    $email = $contactsJsonData->email;

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Контакты</title>
        <!-- css -->
        <link href='https://fonts.googleapis.com/css?family=Comfortaa:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <!-- css -->
    </head>

    <body>
        <!-- header -->
        <header>
            <section>
                <a class="no_under" href="/index.php">
                    <div class="logo inline vm"> <img src="/images/logo.png" alt=""> </div>
                </a>
                <div class="name_comp inline vm">
                    <div class="name_company">Фотомания</div>
                    <ul class="name_company_ul">
                        <li>Полиграфия</li>
                        <li>Дизайн</li>
                        <li>Сувенирная</li>
                        <li>продукция</li>
                        <li>Широкоформатная печать</li>
                    </ul>
                </div>
                <div class="phone inline vm">
                    <div class="phone_number"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;
                        <?= $tel;?>
                    </div>
                    <a class="no_under" href="">
                        <button class="button_buy">Скачать прайс&nbsp;&nbsp;<i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>
                    </a>
                </div>
                <div class="adress inline vm">
                    <div class="adress_city"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;Город
                        <?= $city;?>:</div>
                    <a class="no_under" href="/pages/contacts.php">
                        <div class="adress_street">
                            <?= $addr;?>
                        </div>
                    </a>
                </div>
            </section>
        </header>
        <div class="nav">
            <section>
                <nav>
                    <ul>
                        <li class="nav_punct"><a class="no_under" href="/pages/products.php">Сувенирная продукция</a></li>
                        <li class="nav_punct"><a class="no_under" href="">Полиграфия и дизайн</a></li>
                        <li class="nav_punct"><a class="no_under" href="">Широкоформатная печать</a></li>
                        <li class="nav_punct"><a class="no_under" href="">Прочие услуги</a></li>
                        <li class="nav_punct"><a class="no_under" href="">Акции</a></li>
                        <li class="nav_punct"><a class="no_under" href="/pages/contacts.php">Контакты</a></li>
                    </ul>
                </nav>
            </section>
        </div>
        <!-- header -->
        <section class="wrapper">
            <div class="panel1">
                <div class="breadcrumb inline vm"> <a href="/index.php">Главная</a> / Контакты </div>
                <div class="search inline vm">
                    <input class="search_input" placeholder="Поиск по сайту..." type="text">
                    <button class="search_button"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="contact">
                <h2>Контакты</h2>
                <div class="ca1">
                    <div class="contact_adress">Офис №1: ул. Ленинского Комсомола, д.24</div>
                    <div class="map map1 inline"></div>
                    <div class="building_img build1 inline"> <img src="/images/building_bg.jpg" alt="">
                        <div class="contact_info">
                            <p> <span class="strong">Телефон:</span> 8-920-634-65-93
                                <br> <span class="strong">Email:</span> Admin@mail.ru </p>
                        </div>
                    </div>
                </div>
                <div class="ca2">
                    <div class="contact_adress">Офис №2: ул. Краснорядская, д.25/82</div>
                    <div class="map map1 inline"></div>
                    <div class="building_img build1 inline"> <img src="/images/building_bg.jpg" alt="">
                        <div class="contact_info">
                            <p> <span class="strong">Телефон:</span> 8-920-634-65-93
                                <br> <span class="strong">Email:</span> Admin@mail.ru </p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- footer -->
        <footer>
            <section>
                <a class="no_under" href="/index.php">
                    <div class="logo inline vm"> <img src="/images/logo.png" alt=""> </div>
                </a>
                <div class="name_comp inline vm">
                    <div class="name_company">Фотомания</div>
                    <ul class="name_company_ul">
                        <li>Полиграфия</li>
                        <li>Дизайн</li>
                        <li>Сувенирная</li>
                        <li>продукция</li>
                        <li>Широкоформатная печать</li>
                    </ul>
                </div>
                <div class="phone inline vm">
                    <div class="phone_number"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;
                        <?= $tel;?>
                    </div>
                    <a class="no_under" href="">
                        <button class="button_buy">Скачать прайс&nbsp;&nbsp;<i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>
                    </a>
                </div>
                <div class="adress inline vm">
                    <div class="adress_city"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;Город
                        <?= $city;?>:</div>
                    <a class="no_under" href="/pages/contacts.php">
                        <div class="adress_street">
                            <?= $addr;?>
                    </a>
                    </div>
            </section>
        </footer>
        <!-- footer -->
        <!-- js -->
        <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
        <!-- js -->
    </body>

    </html>