## Endpoints
Todas as rotas disponíveis:

<?php

$content = '<table><tbody>';
$content .= '<tr><td>Nº</td><td>Methods</td><td>Route</td><td>Name</td><td>Public</td></tr>';
foreach($command->getTables() as $table) {
    if ($command->isIgnoredTable($table->Name)) continue;
    foreach(app($table->Controller->NameFull)->getGeneratedRoutes() as $index => $route) {
        $content .= '<tr>';
        $content .= "<td>{$index}</td>";
        $content .= '<td>'. implode(', ', $route->methods) .'</td>';
        $content .= "<td>/api/{$route->path}</td>";
        $content .= "<td>{$route->name}</td>";
        $content .= '<td>'. ($route->is_public? 'ok': '') .'</td>';
        $content .= '</tr>';
    }
}
$content .= '</tbody></table>';
echo $content;

?>

## Estrutura do banco
<img src="../database/schema.svg" alt="" width="100%">