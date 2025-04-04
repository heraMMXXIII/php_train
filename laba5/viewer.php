<?php
function showContacts($pdo) {

    $current_page = max(1, (int)($_GET['page'] ?? 1));
    $per_page = 10;
    $sort = $_GET['sort'] ?? 'id';
    

    $allowed_sorts = ['id', 'surname', 'birthdate'];
    $sort = in_array($sort, $allowed_sorts) ? $sort : 'id';
    

    $stmt = $pdo->prepare("SELECT * FROM contacts ORDER BY $sort LIMIT :offset, :limit");
    $stmt->bindValue(':offset', ($current_page - 1) * $per_page, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $per_page, PDO::PARAM_INT);
    $stmt->execute();
    $contacts = $stmt->fetchAll();


    $total = $pdo->query("SELECT COUNT(*) FROM contacts")->fetchColumn();
    $total_pages = ceil($total / $per_page);

    $html = '<table class="contacts-table">';
    $html .= '<tr><th>ID</th><th>Фамилия</th><th>Имя</th><th>Телефон</th><th>Email</th></tr>';
    
    foreach ($contacts as $contact) {
        $html .= '<tr>';
        $html .= '<td>'.htmlspecialchars($contact['id']).'</td>';
        $html .= '<td>'.htmlspecialchars($contact['surname']).'</td>';
        $html .= '<td>'.htmlspecialchars($contact['name']).'</td>';
        $html .= '<td>'.htmlspecialchars($contact['phone']).'</td>';
        $html .= '<td>'.htmlspecialchars($contact['email']).'</td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    if ($total_pages > 1) {
        $html .= '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $current_page) ? 'active' : '';
            $html .= "<a href='index.php?section=view&page=$i&sort=$sort' class='$active'>$i</a>";
        }
        $html .= '</div>';
    }
    
    return $html;
}
?>