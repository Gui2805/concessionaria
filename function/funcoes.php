<?
session_start();


function cadastro_usuario()
{
    global $conexao;

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return [
            'status' => 404,
            'message' => 'Email ja existe.',
        ];
    }

    $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, password_hash($password, PASSWORD_DEFAULT)]);

    return [
        'status' => 200,
        'message' => 'Usário criado com sucesso.',
    ];
}


function login()
{
    global $conexao;

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return [
            'status' => 404,
            'message' => 'Usuário não encontrado.',
        ];
    }

    if (!password_verify($password, $user['senha'])) {
        return [
            'status' => 404,
            'message' => 'Senha incorreta.',
        ];
    }

    $_SESSION['idusuario'] = $user['idusuario'];
    $_SESSION['nome'] = $user['nome'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['logado'] = true;

    return [
        'status' => 200,
        'message' => 'Login realizado com sucesso.',
    ];
}

function lista_veiculos()
{
    global $conexao;
    //mudar nome da tabela para o que vc colocou nos carros
    $stmt = $conexao->prepare("SELECT * FROM veiculos");
    $stmt->execute();
    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $veiculos;
}

function editar_veiculo()
{
    global $conexao;
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $fabricante = $_POST['fabricante'];
    $tipo = $_POST['tipo'];
    $ano = $_POST['ano'];

    $stmt = $conexao->prepare("UPDATE veiculos SET nome = ?, fabricante = ?, tipo = ?, ano = ? WHERE id = ?");
    $stmt->execute([$nome, $fabricante, $tipo, $ano, $id]);

    return [
        'status' => 200,
        'message' => 'Veículo editado com sucesso.',
    ];
}

function insere_veiculo()
{
    global $conexao;
    $nome = $_POST['nome'];
    $fabricante = $_POST['fabricante'];
    $tipo = $_POST['tipo'];
    $ano = $_POST['ano'];

    $stmt = $conexao->prepare("INSERT INTO veiculos (nome, fabricante, tipo, ano) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $fabricante, $tipo, $ano]);

    return [
        'status' => 200,
        'message' => 'Veículo inserido com sucesso.',
    ];
}

function deleta_veiculo()
{
    global $conexao;
    $id = $_POST['id'];
    $stmt = $conexao->prepare("DELETE FROM veiculos WHERE id = ?");
    $stmt->execute([$id]);
}

function pega_um_veiculo()
{
    global $conexao;
    $id = $_POST['id'];
    $stmt = $conexao->prepare("SELECT * FROM veiculos WHERE id = ?");
    $stmt->execute([$id]);
    $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);
    return $veiculo;
}