<?php


require_once './classes/Select.Class.php';

class ExibeAlbum extends Select{


    public function ExecutaAlbum(){
        $this->MontaAlbum();

    }
    private function MontaAlbum(){
        $this->ExecutaSelect($this->setQuery("SELECT * FROM album"));
        foreach ($this->getResultado() as $albuns)
        {
            echo $albuns['capa'];
        }
    }
}