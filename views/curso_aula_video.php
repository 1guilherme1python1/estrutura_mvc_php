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
    <h1>Vídeo - <?php echo $aula_info['nome']; ?></h1>
    <iframe id="video" src="//player.vimeo.com/video/<?php echo $aula_info['url'];?>" style="width:100%;" frameborder="0"></iframe>
    <?php echo $aula_info['descricao'];?>
    <?php if($aula_info['assistidos'] >= 1):?>
        Esta aula já foi assistida
    <?php else: ?>
        <button id="ButtonMarcarAula" data-id="<?php echo $aula_info['id'];?>">Marcar como assistida</button>
        <?php echo $aula_info['id'];?>
    <?php endif; ?>
    <hr>
    <h3>Duvidas? Deixe nos comentários</h3>
    <form method="POST" class="form_duvida">
        <textarea name="duvida"></textarea>
        <input type="submit" id="buttonDuvida" value="Enviar Dúvida">
    </form>
</div>