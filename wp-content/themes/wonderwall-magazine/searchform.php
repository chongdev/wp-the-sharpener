<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="search-form-inner">
        <input type="search" value="" name="s" id="s" placeholder="<?php esc_attr_e( 'Enter Keywords', 'wonderwall-magazine' ); ?>" />
        <div class="search-form-submit">
        	<input type="submit" id="searchsubmit" value="" />
        	<span class="fa fa-search"></span>
        </div><!-- .search-form-submit -->
    </div>
</form>