<?php
class AjaxController extends Controller{
    public function __construct(){
        $alunos = new Alunos();

        if(!$alunos->isLogged()){
            header('Location:'.BASE_URL);
        }
    }
    public function marcar_assistido($id){
        $aulas = new Aulas();
        $aulas->marcarAssistido($id);
    }
}