## Endpoints
Todas as rotas disponíveis:

<?php

$content = '<table><tbody>';
$content .= '<tr><td>Nº</td><td>Methods</td><td>Route</td><td>Name</td><td>Public</td></tr>';
foreach($command->getTables() as $table) {
    if ($command->isIgnoredTable($table->Name)) continue;
    $content .= '// foreach(all routes)';
}
$content .= '</tbody></table>';
echo $content;

?>

## Estrutura do banco
<img src="../database/schema.svg" alt="" width="100%">