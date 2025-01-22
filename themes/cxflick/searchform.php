<?php $cxflick_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo $cxflick_unique_id; ?>">
        <span class="screen-reader-text"><?php echo _x( 'Tìm kiếm:', 'label', 'cxflick' ); ?></span>
    </label>

    <input type="search" id="<?php echo $cxflick_unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Tìm kiếm &hellip;', 'placeholder', 'cxflick' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />

    <button type="submit" class="btn search-submit">
        <span class="search-reader-text">
            <?php echo _x( 'Tìm kiếm', 'submit button', 'cxflick' ); ?>
        </span>
    </button>
</form>