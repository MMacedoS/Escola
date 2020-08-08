<?
class upload {

    // vari�veis de inst�ncia = colunas da tabela
    var $diretorio;
    var $arquivos;
    var $tamanho = 2097152; // por padr�o est� o tamanho m�ximo de 2 mb, mas pode ser alterado
    var $extensoes;
    var $renomeia = true; // verifica se precisa renomear arquivo
    var $valida_quantidade = false;
    var $_UP = array();
    var $nome_final = "";
    var $msg_error = "";

    // construtor - inicializa o objeto
    function upload($itens) {

            $this->diretorio              = $itens['diretorio'];
            $this->valida_quantidade    = $itens['valida_quantidade'];
            $this->tamanho                = ($itens['tamanho'] == '')   ? $this->tamanho  : $itens['tamanho'];
            $this->extensoes              = ($itens['extensoes'] == '') ? ''              : $itens['extensoes'];
            $this->renomeia               = ($itens['renomeia'] == '')  ? $this->renomeia : $itens['renomeia'];
            $this->arquivos               = ($itens['arquivos'] == '')  ? ''              : $itens['arquivos'];;

            $this->_UP['erros'][0] = 'N�o houve erro';
            $this->_UP['erros'][1] = 'O arquivo no upload � maior do que o limite do PHP';
            $this->_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
            $this->_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
            $this->_UP['erros'][4] = 'N�o foi feito o upload do arquivo';
    }

    function validacoes($arquivo){
        $this->diretorio_existe($this->diretorio);
        $this->verifica_erro_upload($arquivo);
        $this->verifica_extensao_arquivo($arquivo);
        $this->verifica_tamanho_arquivo($arquivo);
    }

    function get_arquivo($arquivo_referencia,$i){
        $arquivo[name]     = $arquivo_referencia[name][$i];
        $arquivo[type]     = $arquivo_referencia[type][$i];
        $arquivo[tmp_name] = $arquivo_referencia[tmp_name][$i];
        $arquivo[error]    = $arquivo_referencia[error][$i];
        $arquivo[size]    = $arquivo_referencia[size][$i];

        return $arquivo;
    }
    function validacoes_varios_arquivos(){
        for ($i=0; $i < sizeof($this->arquivos['name']); $i++) { 
            $arquivo = $this->get_arquivo($this->arquivos,$i);
            $this->validacoes($arquivo);
        }
    }

    function upload_arquivo(){
        if ($this->arquivos != '') {
            $arquivo = $this->arquivos;
            $this->validacoes($arquivo);

            $this->renomeia_arquivo($arquivo);
            $caminho = $this->diretorio ."/". $this->nome_final;
            $this->arquivo_existe($caminho);
            
            if (move_uploaded_file($arquivo['tmp_name'], $caminho)) {
                echo "<br><br>Upload efetuado com sucesso!";
                //echo '<br /><a target="_blank" href="' . $this->diretorio .'/'. $this->nome_final . '">Clique aqui para acessar o arquivo</a>';
            } else {
                echo "$this->msg_error";
            }
        }
    }

    function upload_varios_arquivo(){
        $this->validacoes_varios_arquivos();
        $sucesso = true;
        if ($this->arquivos != '') {

            for ($i=0; $i < sizeof($this->arquivos['name']); $i++) { 
                $arquivo = $this->get_arquivo($this->arquivos,$i);
                
                $this->renomeia_arquivo($arquivo);
                $caminho = $this->diretorio ."/". $this->nome_final;
                $this->arquivo_existe($caminho);

                if (move_uploaded_file($arquivo['tmp_name'], $caminho)) {
                }else{
                    $sucesso = false;
                }
            }
            if ($sucesso) {
                echo "<br><br>Upload efetuado com sucesso!";
            } else {
                echo "$this->msg_error";
            }
        }
    }

    function verifica_erro_upload($arquivo){
        $this->msg_error = ($arquivo['error'] == 4) ? "" : "<br><br>N�o foi poss�vel enviar os arquivos, tente novamente!";
        if ($arquivo['error'] != 0 and $arquivo['error'] != 4) {
            die("<br><br>N�o foi poss�vel fazer o upload, erro:<br />" . $this->_UP['erros'][$arquivo['error']]);
            exit; // Para a execu��o do script
        }
        if ($arquivo['error'] == 4 and $this->valida_quantidade) {
            die("<br><br>N�o foi poss�vel fazer o upload, erro: Nenhum arquivo Selecionado");
            exit;
        }
    }

    function verifica_extensao_arquivo($arquivo){
        if ($this->extensoes != '') {
            $extensao = $this->get_extensao($arquivo);
            if (array_search($extensao, $this->extensoes) === false) {
                die("<br><br>N�o foi poss�vel fazer o upload, erro: O tipo $extensao n�o � aceito");
                exit;
            }
        }
    }

    function verifica_tamanho_arquivo($arquivo){
        if ($this->tamanho < $arquivo['size']) {
            $tamanho_mb = $this->tamanho/1000000;
            die("<br><br>N�o foi poss�vel fazer o upload, erro: O arquivo enviado � muito grande, envie arquivos de at� $tamanho_mb Mb.");
            exit;
        }
    }

    function get_extensao($arquivo){
        $name = $arquivo["name"];
        $ext = strtolower(end((explode(".", $name))));
        return $ext;
    }

    function renomeia_arquivo($arquivo){
        if ($this->renomeia == true) {
            // Cria um nome baseado comid unico e UNIX TIMESTAMP atual 
            $this->nome_final = uniqid().time().'.'.$this->get_extensao($arquivo);
        } else {
            // Mant�m o nome original do arquivo
            $this->nome_final = $arquivo['name'];
        }
    }

    function diretorio_existe($diretorio){
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }
    }

    function listar_arquivos(){
        if (is_dir($this->diretorio)) {
            $input = scandir($this->diretorio);
            $remover = array(".","..");
            $resultado = array_values(array_diff($input, $remover));
            return $resultado;
        }
    }

    function deletar_arquivo($caminho){
        unlink($caminho);
    }

    function arquivo_existe($caminho){
        if (file_exists($caminho)) {
            die("<br><br>N�o foi poss�vel fazer o upload, erro: O arquivo $this->nome_final j� existe");
            exit;
        }
    }


}
?>