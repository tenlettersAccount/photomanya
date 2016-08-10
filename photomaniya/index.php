<?php get_header() ?>
    <section class="wrapper">
        <div class="panel1">
            <div class="breadcrumb inline vm">
                <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' / '); ?>
            </div>
            <?php get_search_form();?>
        </div>
        <div class="contact">
            <h2><?php
                
                add_filter('document_title_parts', function( $parts ){
                    if( isset($parts['site']) ) unset($parts['site']);
                    return $parts;
                });
                
                echo wp_get_document_title(); 
                
                ?></h2>
            <div class="products tl">
                <?php
                // Запуск цикла страницы, который выводит содержимое.
                if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>">
                        <?php if ( ! is_front_page() ) { ?>
                            <?php } ?>
                                <?php the_content(); ?>
                    </article>
                    <!-- #post-## -->
                    <?php endwhile; ?>
            </div>
            <?php 
            $loc = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $loc = substr_count($loc,'/');
            
            if($loc<3){
            $pages = get_pages("child_of=$post->ID"); 
                foreach ( $pages as $page ) {
                    $option = '<div class="project product inline"><div class="project_img">'.get_the_post_thumbnail($page->ID, 'thumbnail').'</div><div class="project_text"><a href="'.get_page_link( $page->ID ). '">';
                    $option .= $page->post_title;
                    $option .= '</a></div></div>';
                    echo $option;
                }
            }
            else{
                    if($post->post_parent)
                      $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
                      else
                      $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
                    if ($children) { 
                      echo '<div class="left_menu inline">';
                      echo '<ul>';
                      echo $children;
                      echo '</ul>';
                      echo '</div>';
                    }
                    //wp_title()
                      echo '<div class="right_wrapper inline">';
                        echo '<div class="product_segment">';
                            echo '<ul>';
                
                                $id= wp_get_document_title(); // ID заданной рубрики
                                $n=3;   // количество выводимых записей
                                $recent = new WP_Query("category_name=$id&showposts=$n");
                                while($recent->have_posts()) : $recent->the_post();
                                ?>
                <div class="product_segment">
                    <?php the_content();?>
                </div>
                <?php endwhile;
                
                            echo '</ul>';
                        echo '</div>';
                      echo '</div>';
                
            }
            ?>
        </div>
    </section>
    <?php get_footer() ?>