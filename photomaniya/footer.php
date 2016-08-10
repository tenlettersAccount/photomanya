<!-- footer -->
<?
    $plugin_path_json_file = plugins_url().'/ten_edit/contacts/contactsData.json';
    $contactsJsonData = json_decode(file_get_contents($plugin_path_json_file, JSON_UNESCAPED_UNICODE));
    $tel = $contactsJsonData->tel;
    $city = $contactsJsonData->city;
    $addr = $contactsJsonData->addr;
    $email = $contactsJsonData->email;
?>
    <footer>
        <section>
            <a class="no_under" href="/index.php">
                <div class="logo inline vm"> <img src="<? bloginfo(stylesheet_directory) ?>/images/logo.png" alt=""> </div>
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
                    <?= $tel?>
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
    </footer>
    <!-- footer -->
    <!-- js -->
    <?php wp_enqueue_script("jquery"); ?>
        <?php wp_footer() ?>
            <!-- js -->
            </body>

            </html>