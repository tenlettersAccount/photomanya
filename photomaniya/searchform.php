<form role="search" class="search inline vm" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
	<input type="text" class="search_input" placeholder="Поиск по сайту..." value="<?php echo get_search_query() ?>" name="s" id="s" />
    <button type="submit" id="searchsubmit" value="найти" class="search_button"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>