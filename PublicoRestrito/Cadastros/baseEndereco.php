<?php

class BaseEndereco
{
    public $cidade_base;
    public $logradouro_base;
    public $estado_base;

    function __construct($cidade_base, $logradouro_base, $estado_base)
    {
        $this->cidade_base = $cidade_base;
        $this->logradouro_base = $logradouro_base;
        $this->estado_base = $estado_base;
    }

}

$cep = $_GET['cep'] ?? '';

if ($cep == '38400-100'){
    $response = new BaseEndereco('Uberlândia', 'Avenida Floriano Peixoto', 'MG');
}
else if($cep =='38405-322'){
    $response = new BaseEndereco('Uberlândia', 'Avenida Levino de Souza', 'MG');
}
else if($cep =='38408-044'){
    $response = new BaseEndereco('Uberlândia', 'Avenida José Zacharias Junqueira', 'MG');
}
else if($cep =='32809-327'){
    $response = new BaseEndereco('Esmeraldas', 'Rua Uberaba', 'MG');
}
else if($cep =='38408-287'){
    $response = new BaseEndereco('Uberlândia', 'Alameda Uberaba', 'MG');
}
 else {
    // Se o CEP não for igual a '38400-100', você precisa definir o $response como algo, senão o PHP gerará um erro.
    // Neste exemplo, estou definindo $response como nulo.
    $response = null;
}

// Certifique-se de que o $response foi inicializado antes de tentar acessá-lo.
// Além disso, é uma boa prática verificar se o cabeçalho Content-Type é definido como JSON.
header('Content-Type: application/json');

echo json_encode($response);
