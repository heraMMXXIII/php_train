<?php
function getMenu($activePage)
{
    $menuItems = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записей',
        'delete' => 'Удаление записей',
    ];

    $menu = '<div class="submenu">';
    foreach ($menuItems as $page => $label) {
        $class = ($activePage == $page) ? 'select' : '';
        $menu .= "<a href='index.php?page=$page' class='$class'>$label</a>";
    }
    $menu .= '</div>';
    return $menu;
}
?>
