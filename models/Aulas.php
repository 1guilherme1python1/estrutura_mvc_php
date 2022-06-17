<?php
class Aulas extends Model{
    public function getAulasDoModulo($id){
        $array = array();
        $sql = $this->db->query("SELECT * FROM aulas WHERE id_modulo='$id' ORDER BY ordem");

        if($sql->rowCount()>0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($array as $aulaChave=>$aula){
                if($aula['tipo'] === 'video'){
                    $sql = $this->db->query("SELECT nome FROM videos WHERE id_aula=".($aula['id'])."");
                    if($sql->rowCount()>0){
                        $nomes = $sql->fetch(PDO::FETCH_ASSOC);
                        $array[$aulaChave]['nome'] = $nomes['nome'];
                    }
                } else {
                    $array[$aulaChave]['nome'] = "Questionário";
                }
            }
        }
        
        return $array;
    }
    public function getCursoDeAula($id){
        $sql = $this->db->query("SELECT id_curso FROM aulas WHERE id = '$id'");

        if($sql->rowCount()>0){
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row['id_curso'];
        } else {
            return 0;
        }
    }
    public function getAula($id){
        $array = array();

        $sql = $this->db->query("SELECT tipo FROM aulas WHERE id='$id'");
        if($sql->rowCount()>0){
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            if($row['tipo'] == 'video'){
                $sql = $this->db->query("SELECT * FROM videos WHERE id_aula='$id'");
                if($sql->rowCount()>0){
                    $array = $sql->fetch(PDO::FETCH_ASSOC);
                    $array['tipo'] = 'video';
                }
            } else {
                $sql = $this->db->query("SELECT * FROM questoes WHERE id_aula='$id'");
                if($sql->rowCount()>0){
                    $array = $sql->fetch(PDO::FETCH_ASSOC);
                    $array['tipo'] = 'quest';
                }
            }

        }

        return $array;
    }
    public function setDuvida($duvida, $id_aluno){
        $this->db->query("INSERT INTO duvidas SET data_duvida = NOW(), duvida='$duvida', id_aluno='$id_aluno'");
    }
}