<?php
class CursosController extends Controller{
    public function __construct(){
        $alunos = new Alunos();
        if(!$alunos->isLogged()){
            header("Location: ".BASE_URL."login");
        }
    }
    public function index(){
        header("Location: ".BASE_URL);
    }
    public function entrar($id){
        $dados = array(
            'curso'=>array(),
            'modulos'=>array(),
            'info' =>array()
        );
        $aluno = new Alunos();
        $aluno->setAluno($_SESSION['lgaluno']);
        $dados['info'] = $aluno;

        if($aluno->IsIncrito($id)){
            $cursos = new Cursos();
            $cursos->setCursos($id);
            $dados['curso'] = $cursos;

            $modulos = new Modulos();
            $dados['modulos']= $modulos->getModulos($id);
            

            $this->loadTemplate('CursoEntrar', $dados); 
        } else {
            header("Location: ".BASE_URL);
        }
    }
    public function aula($id_aula){
        $dados = array(
            'curso'=>array(),
            'modulos'=>array(),
            'info' =>array(),
            'aula_info'=>array(),
            'resposta',
        );
        $aluno = new Alunos();
        $aluno->setAluno($_SESSION['lgaluno']);
        $dados['info'] = $aluno;

        $aulas = new Aulas();
        $id = $aulas->getCursoDeAula($id_aula);

        if($aluno->IsIncrito($id)){
            $cursos = new Cursos();
            $cursos->setCursos($id);
            $dados['curso'] = $cursos;

            $modulos = new Modulos();
            $dados['modulos']= $modulos->getModulos($id);

            $dados['aula_info'] = $aulas->getAula($id_aula);
            
            if($dados['aula_info']['tipo'] == 'video'){
                $view = 'curso_aula_video';
            } else {
                $view = 'curso_aula_quest';
                if(!isset($_SESSION['quest'.$id_aula])){
                $_SESSION['quest'.$id_aula] = 1;
                }
            }
            
            if(isset($_POST['duvida']) && !empty($_POST['duvida'])){
                $duvida = addslashes($_POST['duvida']);

                $aulas->setDuvida($duvida, $aluno->getId());
            }

            if(isset($_POST['opcao']) && !empty($_POST['opcao'])){
                
                $opcao = addslashes($_POST['opcao']);
                
                if($opcao == $dados['aula_info']['resposta']){
                    $dados['resposta'] = true;
                } else {
                    $dados['resposta'] = false;
                }
                $_SESSION['quest'.$id_aula]++;
                if($_SESSION['quest'.$id_aula]===2){
                    
                }
            }

            $this->loadTemplate($view, $dados); 
        } else {
            header("Location: ".BASE_URL);
        }
    }
}