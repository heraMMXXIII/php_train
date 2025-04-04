<?php
function getMenu($activePage) {
    $menu = '<div class="submenu">';
    
    $items = [
        'view' => 'Просмотр',
        'add' => 'Добавить запись',
        'edit' => 'Редактировать запись', 
        'delete' => 'Удалить запись'
    ];
    
    foreach ($items as $page => $title) {
        $class = ($activePage == $page) ? 'select' : '';
        $menu .= "<a href='index.php?section=$page' class='$class'>$title</a>";
    }
    
    $menu .= '</div>';
    
    if ($activePage == 'view') {
        $sortTypes = [
            'id' => 'По порядку',
            'surname' => 'По фамилии',
            'birthdate' => 'По дате рождения'
        ];
        
        $currentSort = $_GET['sort'] ?? 'id';
        $menu .= '<div class="submenu" style="font-size:0.8em">';
        
        foreach ($sortTypes as $type => $title) {
            $class = ($currentSort == $type) ? 'select' : '';
            $menu .= "<a href='index.php?section=view&sort=$type' class='$class'>$title</a>";
        }
        
        $menu .= '</div>';
    }
    
    return $menu;
}
?>