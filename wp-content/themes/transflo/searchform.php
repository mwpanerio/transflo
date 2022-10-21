<?php
/**
 * If your form is generated using get_search_form() you do not need to do this,
 * as SearchWP Live Search does it automatically out of the box
 */
?>
<form action="/" method="get">
    <input type="text" placeholder="What can we help you find?" name="s" id="s" value="<?php echo get_search_query( true ); ?>" data-swplive="true">
    <button type="submit"><i class="icon-search"></i></button>
</form>
