<?php
session_start();
/**
 * @package ten_edit
 */
/*
Plugin Name: ten_edit
Plugin URI: https://akismet.com/
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="https://akismet.com/get/">Sign up for an Akismet plan</a> to get an API key, and 3) Go to your Akismet configuration page, and save your API key.
Version: 3.1.11
Author: Automattic
Author URI: https://automattic.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: akismet
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/


// Hook for adding admin menus
add_action('admin_menu', 'mt_add_pages');


// action function for above hook
function mt_add_pages() {
    
    // Add a new top-level menu (ill-advised):
    add_menu_page('Catalog', 'Tenletters plugin', 8, __FILE__, 'mt_toplevel_page');

    // Add a submenu to the custom top-level menu:
   // add_submenu_page(__FILE__, 'settings', 'Настройки', 8, 'sub-page', 'mt_sublevel_page');

    // Add a second submenu to the custom top-level menu:
    add_submenu_page(__FILE__, 'home', 'Добавить продукт', 8, 'sub-page2', 'mt_sublevel_page2');
    
    add_submenu_page(__FILE__, 'subpages', 'Контакты', 8, 'sub-page3', 'mt_sublevel_page3');
    add_submenu_page(__FILE__, 'subpages', 'FAQ', 8, 'sub-page4', 'mt_sublevel_page4');
    
    //add_submenu_page(__FILE__, 'Invites', 'Заявки', 8, 'sub-page4', 'mt_sublevel_page4');
    
    //add_submenu_page(__FILE__, 'feedback', '<span style="color:red">Обратная связь</span>', 8, 'sub-page5', 'mt_sublevel_page5');
    
}


// mt_toplevel_page() displays the page content for the custom Test Toplevel menu
function mt_toplevel_page() {
    echo "<h2>О плагине</h2>";
}

// mt_sublevel_page() displays the page content for the first submenu
// of the custom Test Toplevel menu
function mt_sublevel_page() {
    echo "<h2>Администрирование сайта</h2>";
}

// mt_sublevel_page2() displays the page content for the second submenu
// of the custom Test Toplevel menu
function mt_sublevel_page2() {
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    ';
    echo "<h5>Главная страница</h5>
    <hr>
    ";
    echo '
    <div class="row">
    
        <div class="col s4">
        </div>
        
        <div class="col s12" style="margin-top:20px;">
          <ul class="tabs">
            <li class="tab col s3"><a href="#test1">Товар 1</a></li>
            <li class="tab col s3"><a class="active" href="#test2">Товар 2</a></li>
            <li class="tab col s3"><a href="#test3">Товар 3</a></li>
            <li class="tab col s3"><a href="#test4">Товар 4</a></li>
            <li class="tab col s3"><a href="#test4">Товар 5</a></li>
          </ul>
        </div>
        <div id="test1" class="col s12"><a class="btn" style="margin-top:20px;">Выбрать</a> &nbsp;&nbsp;&nbsp;<div style="margin-top:20px;">- Выбрать товары для карусели</div></div>
        <div id="test2" class="col s12"><a class="btn" style="margin-top:20px;">Выбрать</a> &nbsp;&nbsp;&nbsp;<div style="margin-top:20px;">- Выбрать товары для карусели</div></div>
        <div id="test3" class="col s12"><a class="btn" style="margin-top:20px;">Выбрать</a> &nbsp;&nbsp;&nbsp;<div style="margin-top:20px;">- Выбрать товары для карусели</div></div>
        <div id="test4" class="col s12"><a class="btn" style="margin-top:20px;">Выбрать</a> &nbsp;&nbsp;&nbsp;<div style="margin-top:20px;">- Выбрать товары для карусели</div></div>
        
        <div class="col s12" style="margin-top:20px;">
          <ul class="tabs">
            <li class="tab col s3"><a href="#test5">Отзыв 1</a></li>
            <li class="tab col s3"><a href="#test6">Отзыв 2</a></li>
            <li class="tab col s3"><a href="#test7">Отзыв 3</a></li>
          </ul>
        </div>
        <div id="test5" class="col s12"><a class="btn" style="margin-top:20px;">Выбрать</a> &nbsp;&nbsp;&nbsp;<div style="margin-top:20px;">- Выбрать отзыв</div></div>
        <div id="test6" class="col s12"><a class="btn" style="margin-top:20px;">Выбрать</a> &nbsp;&nbsp;&nbsp;<div style="margin-top:20px;">- Выбрать отзыв</div></div>
        <div id="test7" class="col s12"><a class="btn" style="margin-top:20px;">Выбрать</a> &nbsp;&nbsp;&nbsp;<div style="margin-top:20px;">- Выбрать отзыв</div></div>
        
        <div class="col s12" style="margin-top:50px;">
            <hr>
            <a class="btn green save_all" style="display:inline-block;vertical-align:top;">Сохранить</a>
            
            <div class="preloader-wrapper small active" style="style="display:inline-block;vertical-align:top;"margin-top:20px;margin-left:20px;">
              <div class="spinner-layer spinner-green-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
            
            <div class="results" style="margin-top:20px;">
            </div>
        </div>
        
        <script src="http://materializecss.com/bin/materialize.js"></script>
        <style>
        .preloader-wrapper{
            display: none;
        }
        </style>
        <script>
        $(document).ready(function(){
            $(".carousel").carousel();
            
            var diract ="data/pages/";
            
            $(".save_all").click(function(){
                $(".preloader-wrapper").css("display","inline-block");
                $.ajax({
                    type: "POST",
                    url: "/wp-content/plugins/ten_edit/modules/create/create.php",
                    data: "name=home.tmp&diract="+diract,
                    success: function(data){
                        $(".results").html(data);
                    }
                });
            });
        });
        </script>
    </div>';
    
}
function mt_sublevel_page3() {
    if(isset($_SESSION['contact_updater_message'])){
        echo "
            <h2>". $_SESSION['contact_updater_message'] ."</h2>
        ";
        $_SESSION['contact_updater_message'] = null;
    }
    
     if(isset($_SESSION['yandexMapMessage'])){
            echo "<h2>". $_SESSION['yandexMapMessage'] ."</h2>";
            $_SESSION['yandexMapMessage'] = null;    
     }
    
    echo "
    <div id='admin-contact-form-update'>
        <br><form action='".plugins_url()."/ten_edit/contact-updater.php' method='post'>
            <input style='width:300px' type='text' placeholder='Телефон' id='tel' name='tel'><br>
            <input style='width:300px' type='text' placeholder='Город' id='city' name='city'><br>
            <input style='width:300px' type='text' placeholder='Адрес' id='addr' name='addr'><br>
            <input style='width:300px' type='text' placeholder='Email' id='email' name='email'><br>
            <button id='submit'>Сохранить контакты</button>
        </form><hr>
        
        <form action='".plugins_url()."/ten_edit/yandexMapUpdater.php' method='post'>
            <h4>Для получения координат карты необходимо перейти по ссылке > <a href='https://tech.yandex.ru/maps/tools/constructor/' target='_blank'>Конструктор</a></h4>
            <h4>Далее:</h4>
            <ol>
                <li>Создать новую карту</li>
                <li>Нажав на кнопку 'Метки', отметить на карте желаемое местоположение, нажать кнопку готово</li>
                <li>Сохранить и продолжить</li>
                <li>Центрировать карту так что бы метка была посередине карты, для более корректного отображения карты необходимо задать размеры карты 512х312</li>
                <li>Получить код карты</li>
                <li>Скопированный скрипт вставить в текстовое поле ниже &darr; и сохранить</li>
            </ol>
            <input style='width:400px' type='text' placeholder='Скрипт Яндекс карты' name='yandexMapScript'><br><br>
            <button>Сохранить координаты карты</button>
        </form>
    </div>
    
    ";
        
}
function mt_sublevel_page4(){
    echo "<ol>
        <li>Изображения миниатюр необходимо загружать с размером не более чем 267 × 189</li>
    </ol>";
}
function mt_sublevel_page5() {
}
?>