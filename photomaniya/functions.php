<?php

/**
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * @param  string [$sep = '']       Разделитель. По умолчанию ' » '
 * @param  array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param  array  [$args = array()] Дополнительные аргументы.
 * @return string HTML код
 *
 * version 2.3
 */

add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
//add_theme_support( 'post-thumbnails', array( 'page' ) );

function kama_breadcrumbs( $sep = '', $l10n = array(), $args = array() ){
	global $post, $wp_query, $wp_post_types;

	// Локализация
	$def_l10n = array(
		'home'       => 'Главная',
		'paged'      => 'Страница %d',
		'_404'       => 'Ошибка 404',
		'search'     => 'Результаты поиска по запросу - <b>%s</b>',
		'author'     => 'Архив автора: <b>%s</b>',
		'year'       => 'Архив за <b>%d</b> год',
		'month'      => 'Архив за: <b>%s</b>',
		'day'        => '',
		'attachment' => 'Медиа: %s',
		'tag'        => 'Записи по метке: <b>%s</b>',
		'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
		// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
		// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
	);

	// Параметры по умолчанию
	$def_args = array(
		'on_front_page'   => true,  // выводить крошки на главной странице
		'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
		// можно указать строку вида <span>%s</span>, когда нужно обернуть заголовок в html
		'sep'             => ' » ', // разделитель
		'markup'          => 'schema.org',
		// 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
		// или можно указать свой массив разметки:
		// array( 'wrap'=>'<div class="kama_breadcrumbs">',   'wrap_close'=>'</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
		'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
		'priority_terms'  => array(),
		// 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
		// Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
		// 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
		// порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
		'nofollow' => false, // добавлять rel=nofollow к ссылкам?
	);

	// Фильтрует аргументы по умолчанию
	$loc  = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', $def_l10n ), $l10n );
	$args = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', $def_args ), $args );

	if( ! $sep ) $sep = $args->sep;

	// микроразметка ---
	if(1){
		$mrk = & $args->markup;

		// Разметка по умолчанию default
		if( ! $mrk ){
			$mrk = array(
				'wrap'       => '<div class="kama_breadcrumbs">',
				'wrap_close' => '</div>',
				'linkpatt'   => '<a href="%s">%s</a>',
				'sep_after'  => '',
			);
		}
		if( $mrk == 'rdf.data-vocabulary.org' ){
			$mrk = array(
				'wrap'       => '<div class="kama_breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">',
				'wrap_close' => '</div>',
				'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
				'sep_after'  => '</span>', // закрываем span после разделителя!
			);
		}
		// schema.org
		elseif( $mrk == 'schema.org' ){
			$mrk = array(
				'wrap'       => '<div class="kama_breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">',
				'wrap_close' => '</div>',
				'linkpatt'   => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a></span>',
				'sep_after'  => '', // закрываем span после разделителя!
			);
		}
		elseif( ! is_array($mrk) )
			die( __FUNCTION__ .': "markup" parameter must be array...');

		$wrap       = $mrk['wrap']."\n";
		$wrap_close = $mrk['wrap_close']."\n";
		$linkpatt   = $args->nofollow ? str_replace('<a ','<a rel="nofollow"', $mrk['linkpatt']) : $mrk['linkpatt'];
		$sep       .= $mrk['sep_after']."\n";
	}

	// может это архив пустой таксы
	if( empty($post) )
		$ptype = & $wp_post_types[ get_taxonomy( get_queried_object()->taxonomy )->object_type[0] ];
	else
		$ptype = & $wp_post_types[ $post->post_type ];

	// paged
	$pg_end = '';
	if( $paged_num = $wp_query->query_vars['paged'] ){
		$pg_end  = /*'</a>'.*/ $sep . sprintf( $loc->paged, (int) $paged_num );
	}

	// OUT
	$out = '';

	// front page
	if( is_front_page() ){
		return $args->on_front_page ? ( print $wrap .( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ). $wrap_close ) : '';
	}
	// страница записей, когда для главной установлена отдлеьаная старница.
	elseif( is_home() ) {
		$q_obj = & $wp_query->queried_object;
		$out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj->ID), $q_obj->post_title ) . $pg_end ) : $q_obj->post_title;
	}
	elseif( is_404() ){
		$out = $loc->_404;
	}
	elseif( is_search() ){
		$out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
	}
	elseif( is_author() ){
		$q_obj = & $wp_query->queried_object;
		$tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
		$out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
	}
	elseif( is_year() || is_month() || is_day() ){
		$y_url  = get_year_link( $year = get_the_time('Y') );

		if( is_year() ){
			$tit = sprintf( $loc->year, $year );
			$out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
		}
		// month day
		else {
			$y_link = sprintf( $linkpatt, $y_url, $year);
			$m_url  = get_month_link( $year, get_the_time('m') );

			if( is_month() ){
				$tit = sprintf( $loc->month, get_the_time('F') );
				$out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
			}
			elseif( is_day() ){
				$m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
				$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
			}
		}
	}
	// Древовидные записи
	elseif( is_singular() && $ptype->hierarchical ){
		$out = __hierarchical_posts( $args, $sep, $linkpatt, $post );
	}
	// Таксы, вложения и не древовидные записи
	else {
		$term = false;

		// определяем термин для записей (включая вложения attachments)
		if( is_singular() ){
			// Чтобы определить термин для вложения
			if( is_attachment() && $post->post_parent ){
				$save_post = $post;
				$post = get_post( $post->post_parent );

				if( is_post_type_hierarchical( $post->post_type ) ){
					$hierarchical_post_attach_out = __hierarchical_posts( $args, $sep, $linkpatt, $post );
				}
			}

			// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
			$taxonomies = get_object_taxonomies( $post->post_type );
			// оставим только древовидные и публичные, мало ли...
			$taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

			if( $taxonomies ){
				// сортируем по приоритету
				if( ! empty($args->priority_tax) ){
					usort( $taxonomies, function($a,$b)use($args){
						$a_index = array_search($a, $args->priority_tax);
						if( $a_index === false ) $a_index = 9999999;

						$b_index = array_search($b, $args->priority_tax);
						if( $b_index === false ) $b_index = 9999999;

						return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
					} );
				}

				// пробуем получить термины, в порядке приоритета такс
				foreach( $taxonomies as $taxname ){
					if( $terms = get_the_terms( $post->ID, $taxname ) ){
						// проверим приоритетные термины для таксы
						$prior_terms = & $args->priority_terms[ $taxname ];
						if( $prior_terms && count($terms) > 2 ){
							foreach( (array) $prior_terms as $term_id ){
								$filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
								$_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

								if( $_terms ){
									$term = array_shift( $_terms );
									break;
								}
							}
						}
						else
							$term = array_shift( $terms );

						break;
					}
				}
			}

			if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
		}
		// таксономии
		else
			$term = get_queried_object();

		// строим вывод ---

		//if( ! $term && ! is_attachment() ) return print "Error: Taxonomy is not defined!";

		// вложение древовидного типа записи
		if( isset($hierarchical_post_attach_out) ){
			$out = $hierarchical_post_attach_out . sprintf( $linkpatt, get_permalink( $post->post_parent ), get_the_title( $post->post_parent ) ) . $sep . __show_post_title( $args->show_post_title, $post->post_title );
		}
		// если есть термин
		elseif( $term && isset($term->term_id) ){
			$term = apply_filters('kama_breadcrumbs_term', $term );

			$term_tit_patt = '';
			if( $term->term_id )
				$term_tit_patt = $paged_num ? sprintf( $linkpatt, get_term_link($term->term_id, $term->taxonomy), '{title}' ) . $pg_end : '{title}';

			// attachment
			if( is_attachment() ){
				if( ! $post->post_parent )
					$out = sprintf( $loc->attachment, esc_html($post->post_title) );
				else{
					$tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) ) . $sep . __show_post_title( $args->show_post_title, $post->post_title );
					$out = __crumbs_tax( $term->term_id, $term->taxonomy, $sep, $linkpatt ) . $tit;
				}
			}
			// single
			elseif( is_single() ){
				$out = __crumbs_tax( $term->parent, $term->taxonomy, $sep, $linkpatt ) . sprintf( $linkpatt, get_term_link( $term->term_id, $term->taxonomy ), $term->name ). $sep . __show_post_title( $args->show_post_title, $post->post_title );
				// Метки, архивная страница типа записи, произвольные одноуровневые таксономии
			}
			// taxonomy не древовидная
			elseif( ! is_taxonomy_hierarchical( $term->taxonomy ) ){
				// метка
				if( is_tag() )
					$out = str_replace('{title}', sprintf( $loc->tag, $term->name ), $term_tit_patt );
				// таксономия
				elseif( is_tax() ){
					$post_label = $ptype->labels->name;
					$tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
					$out = str_replace('{title}', sprintf( $loc->tax_tag, $post_label, $tax_label, $term->name ), $term_tit_patt );
				}
			}
			// Рубрики и таксономии
			else{
				//die( $term->taxonomy );
				$out = __crumbs_tax( $term->parent, $term->taxonomy, $sep, $linkpatt ) . str_replace('{title}', $term->name, $term_tit_patt );
			}
		}
		// если это запись, и у нее нет ни одного термина
		elseif( is_singular() )
			$out = __show_post_title( $args->show_post_title, $post->post_title );
	}

	$home_after = '';

	// замена ссылки на архивную страницу для типа записи
	$home_after = apply_filters('kama_breadcrumbs_home_after', false, $linkpatt, $sep, $ptype );

	if( false === $home_after ){
		// Ссылка на архивную страницу произвольно типа поста: для отдельных страниц этого типа; для архива этого типа; для таксономий связанных с этим типом.
		if( $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
			&& ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
		){
			$pt_title = $ptype->labels->name;

			// первая страница архива типа записи
			if( is_post_type_archive() && ! $paged_num )
				$home_after = $pt_title;
			// singular, paged post_type_archive, tax
			else{
				$home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

				$home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
			}
		}
	}
	//current_user_can('administrator') && print_r($ptype);

	$home = sprintf( $linkpatt, home_url(), $loc->home ). $sep . $home_after;

	$out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $args );

	$out = $wrap. $home . $out . $wrap_close;

	return print apply_filters('kama_breadcrumbs', $out, $sep, $loc, $args );
}
function __hierarchical_posts( $args, $sep, $linkpatt, $post ){
	$parent = $post->post_parent;

	$crumbs = array();
	while( $parent ){
		$page = get_post( $parent );
		$crumbs[] = sprintf( $linkpatt, get_permalink( $page->ID ), $page->post_title );
		$parent = $page->post_parent;
	}
	$crumbs = array_reverse( $crumbs );

	$out = '';
	foreach( $crumbs as $crumb )
		$out .= $crumb . $sep;

	return $out . __show_post_title( $args->show_post_title, $post->post_title );
}
function __show_post_title( $is_show, $title ){
	return $is_show ? ( is_string($is_show) ? sprintf( $is_show, esc_html($title) ) : esc_html($title) ) : '';
}
function __crumbs_tax( $term_id, $tax, $sep, $linkpatt ){
	$termlink = array();
	while( $term_id ){
		$term2      = get_term( $term_id, $tax );
		$termlink[] = sprintf( $linkpatt, get_term_link( $term2->term_id, $term2->taxonomy ), esc_html($term2->name) ). $sep;
		$term_id    = $term2->parent;
	}

	$termlinks = array_reverse( $termlink );

	return implode('', $termlinks );
}


/**
 * Изменения:
 *
 * 2.3
 * ADD: Страница записей, когда для главной установлена отделенная страница.
 *
 * 2.2
 * ADD: Link to post type archive on taxonomies page
 *
 * 2.1
 * ADD: $sep, $loc, $args params to hooks
 *
 * 2.0
 * ADD: в фильтр 'kama_breadcrumbs_home_after' добавлен четвертый аргумент $ptype
 *
 * 1.9
 * ADD: фильтр 'kama_breadcrumbs_default_loc' для изменения локализации по умолчанию
 *
 * 1.8
 * FIX: заметки, когда в рубрике нет записей
 *
 * 1.7
 * Улучшена работа с приоритетными таксономиями.
 */