<?
try {
    $conexao = new PDO('mysql:host=localhost:3306;dbname=loja', "root", "root", array(PDO::ATTR_PERSISTENT => true));
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conexao->exec("set names utf8");
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    die();
}
?>