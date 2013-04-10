<?php
$submenu3 = array(
    array(
        'text'  => 'Sub Menu 3.1',
        'attr'  => 'attribute',
        'link'  => '#'
    ),
    array(
        'text' => 'Sub menu 3.2',
        'attr'  => 'attribute',
        'link'  => '#'
    )
);
#Menu::sub($submenu3,3);
#Menu::create('Text','link','Attribute','posisi')
Menu::create('Cart','?m=carts','attribute',1);
Menu::create('Create','?m=post','attribute',10);
Menu::create('Plugins','?m=plugins','attribute',20);
Menu::create('Menu 4','link','attribute',30);

?>
