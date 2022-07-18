<div class="cursoinfo">
    <img src="<?php echo BASE_URL?>assets/images/<?php echo $curso->getImagem();?>" height="60"/>
    <h3><?php echo $curso->getNome();?></h3>
    <?php echo $curso->getDesc();?>
</div>
<div class="curso_left">
    <?php foreach($modulos as $modulo):?>
        <div class="modulo"><?php echo $modulo['nome'];?></div>
        <?php foreach($modulo['aulas'] as $aula):?>
            <a class="hiperlink" href="<?php echo BASE_URL;?>cursos/aula/<?php echo $aula['id'];?>"><div class="aula"><?php echo $aula['nome'];?></div></a>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
<div class="curso_right">
    <h1>Aula Questionário</h1>
    <?php
    if($_SESSION['quest'.$aula_info['id_aula']]>2){
        echo "você atingiu o limite de tentativas";
    } else {
        echo 'Tentativas: '.$_SESSION['quest'.$aula_info['id_aula']].' de 2';
    ?>
    <h3><?php echo $aula_info['pergunta'];?></h3>
<form action="" method="POST">
    <input type="radio" name="opcao" value="1" id="opcao1"/>
    <label for="opcao1"><?php echo $aula_info['opcao1']?></label><br><br>

    <input type="radio" name="opcao" value="2" id="opcao2"/>
    <label for="opcao2"><?php echo $aula_info['opcao2']?></label><br><br>

    <input type="radio" name="opcao" value="3" id="opcao3"/>
    <label for="opcao3"><?php echo $aula_info['opcao3']?></label><br><br>

    <input type="radio" name="opcao" value="4" id="opcao4"/>
    <label for="opcao4"><?php echo $aula_info['opcao4']?></label><br><br>

    <input type="submit" value="Enviar Resposta">
</form>
    <?php if(isset($resposta)){
        if($resposta === true){
            echo "Resposta Correta";
        } else {
            echo "Resposta Errada"; 
        }
    } 
    ?>
    <?php } ?>
</div>