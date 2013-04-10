<!doctype HTML>
<html>
    <head>
        <title>Testing Templating</title>
        <?php echo Template::stylesheet(array('styles.css','blue/style.css'));?>
        <?php 
        $javascript[] = "jquery.min.js";
        $javascript[] = "jquery-ui.min.js";
        $javascript[] = "tables/jquery.metadata.js";
        $javascript[] = "tables/jquery.tablesorter.min.js";
        $javascript[] = "tables/jquery.table-filter.min.js";
        $javascript[] = "functions.js";
        echo Template::javascript($javascript);?>
    </head>
    <body>
        <div class="ch-top-menus">
            <?php echo Menu::generate();?>
        </div>
        <div class="content">
            <?php echo Template::showContent();?>
        </div>
    </body>
</html>