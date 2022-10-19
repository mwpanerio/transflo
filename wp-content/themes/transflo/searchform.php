<?php
/**
 * If your form is generated using get_search_form() you do not need to do this,
 * as SearchWP Live Search does it automatically out of the box
 */
?>
<form action="/" method="get">
    <p>
        <label for="s">Search</label>
        <input type="text" name="s" id="s" value="<?php echo get_search_query( true ); ?>" data-swplive="true" /> <!-- data-swplive="true" enables SearchWP Live Search -->
    </p>
    <p>
        <button type="submit">Search</button>
    </p>
</form>
