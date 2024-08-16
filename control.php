<?
// include_once 'conexao.php';
include_once 'function/funcoes.php';

echo json_encode(match ($_POST['acao'] ?? $_GET['acao']) {
    "login"            => login(),
    "cadastro_usuario" => cadastro_usuario(),
    "lista_veiculos"   => lista_veiculos(),
    "editar_veiculo"   => editar_veiculo(),
    "insere_veiculo"   => insere_veiculo(),
    "deleta_veiculo"   => deleta_veiculo(),
    "pega_um_veiculo"  => pega_um_veiculo(),
    default => throw new Exception('Ação Inválida:' . json_encode($_POST))
});

?>