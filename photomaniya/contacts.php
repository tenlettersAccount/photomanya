<?php
/*
Template Name: Contacts
*/
?>
    <?
    $plugin_path_json_file = plugins_url().'/ten_edit/contacts/contactsData.json';
    $contactsJsonData = json_decode(file_get_contents($plugin_path_json_file, JSON_UNESCAPED_UNICODE));
    $tel = $contactsJsonData->tel;
    $city = $contactsJsonData->city;
    $addr = $contactsJsonData->addr;
    $email = $contactsJsonData->email;

    $plugin_path_json_fileMap = plugins_url().'/ten_edit/contacts/yandexMapScript.json';
    $mapScriptJsonData = json_decode(file_get_contents($plugin_path_json_fileMap, JSON_UNESCAPED_UNICODE));
    $mapScript = $mapScriptJsonData->mapScript;
?>
        <?php get_header(); ?>
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
                        <div class="contact_adress">
                            <?= $addr;?>
                        </div>
                        <div class="map map1 inline">
                            <?= $mapScript;?>
                        </div>
                        <div class="building_img build1 inline">
                            <?php echo get_the_post_thumbnail();?>
                                <div class="contact_info">
                                    <p> <span class="strong">Телефон:</span>
                                        <?= $tel;?>
                                            <br> <span class="strong">Email:</span>
                                            <?= $email;?>
                                    </p>
                                </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php get_footer(); ?>