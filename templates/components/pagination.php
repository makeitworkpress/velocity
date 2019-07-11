
<?php
/**
 * Displays pagination for use within posts or projects
 * The variable $meta is defined by the classes/components/components.php file and filled by classes/components/meta.php
 */
?>
<nav class="pagination-component">
    <?php echo $pagination['prev']; ?>
    <?php echo $pagination['next']; ?>         
</nav>