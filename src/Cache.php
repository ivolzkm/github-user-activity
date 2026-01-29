<?php

namespace App;

class Cache{
    private string $cacheDir;
    private int $ttl; //Time To Live em segundos

    //Define a configuração inicial do cache e garante que o diretório existe. 
    public function __construct(string $cacheDir = '.chache', int $ttl = 300) {
        $this->cacheDir = $cacheDir;
        $this->ttl = $ttl;

        //Garante a existência do diretório cache criando caso não existe (0777 são as permissões do diretório Unix/Linux).
        //0777 -> leitura = 4 + escrita 2 + execução 1 = 7 (igualmente em dono, grupo, e outros)
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true); 
        }
    }
    //Gerar nome de arquivo seguro baseado na chave (ex: username)
    private function getFilePath(string $key): string {
        return $this->cacheDir . DIRECTORY_SEPARATOR . md5($key) .'json';        
    }
    //Verifica se o cache da chave ainda está válido (não expirou)
    public function isFresh(string $key):bool{
        // Se o arquivo não existe, o cache está inválido
        $file = $this->getFilePath($key);
        if (!file_exists($file)){
            return false;
        }
        //Calcula: (tempo agora - última modificação do arquivo) < tempo de vida ?
        // Se verdadeiro, está dentro do ttl e não expirou
        // Se falso, o cache expirou.
        return (time() - filemtime($file)) < $this-> ttl;
    }

    //Lê os dados do cache se ainda estiverem válidos, retornando null se o cache estiver inválido
    public function get(string $key): ?array {
        if (!$this-> isFresh($key)){
            return null;
        }
        $data = file_get_contents(($this->getFilePath($key)));
        return json_decode($data, true);
    }
    //Salva os dados no cache, convertendo o array para JSON e armazenando em um arquivo. 
    public function set(string $key, array $data):void{
        file_put_contents($this->getFilePath($key), json_encode($data));
    }
}