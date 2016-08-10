<!DOCTYPE html>
<?
    $plugin_path_json_file = plugins_url().'/ten_edit/contacts/contactsData.json';
    $contactsJsonData = json_decode(file_get_contents($plugin_path_json_file, JSON_UNESCAPED_UNICODE));
    $tel = $contactsJsonData->tel;
    $city = $contactsJsonData->city;
    $addr = $contactsJsonData->addr;
    $email = $contactsJsonData->email;
?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Фотомания</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- css -->
        <link href='https://fonts.googleapis.com/css?family=Comfortaa:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="<? bloginfo(stylesheet_directory) ?>/css/main.css">
        <link rel="stylesheet" href="<? bloginfo(stylesheet_directory) ?>/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="<? bloginfo(stylesheet_directory) ?>/css/swiper.css">
        <link rel="stylesheet" href="<? bloginfo(stylesheet_directory) ?>/css/mobile/style.css" media="only screen and (max-width:500px)">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <!-- css -->
        <!-- js social -->
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?125"></script>
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?125"></script>
        <script type="text/javascript" src="<? bloginfo(stylesheet_directory) ?>/js/swiper.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.0.js" integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<? bloginfo(stylesheet_directory) ?>/js/scripts.js"></script>
        <!-- js social -->
        <style>
            nav .children {
                display: none;
            }
            
            .left_menu ul li a {
                color: black;
            }
            
            .left_menu ul li {
                display: block;
                text-align: left;
                padding: 5px;
                padding-left: 15px;
                padding-right: 15px;
                border-bottom: 1px solid #dbe8f4;
                cursor: pointer;
            }
            
            .left_menu ul li:last-child {
                padding-bottom: 0;
                border-bottom: none;
            }
            
            .left_menu ul li:first-child {
                padding-left: 15px;
            }
            
            .left_menu ul li li {
                display: none;
            }
            
            .product_segment ul {
                margin-left: 0;
                padding-left: 0;
            }
        </style>
        <?php wp_head() ?>
    </head>

    <body>
        <!-- header -->
        <header>
            <section>
                <a class="no_under" href="/index.php">
                    <div class="logo inline vm"> <img src="<? bloginfo(stylesheet_directory) ?>/images/logo.png" alt=""> </div>
                </a>
                <div class="name_comp inline vm">
                    <div class="name_company">
                        <? bloginfo(name) ?>
                    </div>
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
                    <a class="no_under" href="<? bloginfo(stylesheet_directory) ?>/pages/contacts.php">
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
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                </nav>
            </section>
        </div>
        <!-- header -->