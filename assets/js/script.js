let cursoL = document.querySelector('.curso_left');
let cursoR = document.querySelector('.curso_right');
let topoCursoInfo = document.querySelector('.cursoinfo');
let topoTemplate = document.querySelector('.topo');
let buttonDuvida = document.getElementById('buttonDuvida');
let video = document.getElementById('video');
let ButtonMarcarAula = document.getElementById('ButtonMarcarAula');

function updateArea(){
    let heightTopoCurso = window.getComputedStyle(topoCursoInfo).height.replace('px', '');
    let heightTemplate = window.getComputedStyle(topoTemplate).height.replace('px', '');
    let alturaTela = window.innerHeight;
    let alturaTemplate = parseInt(heightTopoCurso) + parseInt(heightTemplate);
    let altura = alturaTela-alturaTemplate-1;

    cursoL.style.height = `${altura}px`;
    cursoR.style.height = `${altura}px`;

    let ratio = 1920/1080;
    let video_largura = window.getComputedStyle(video).width.replace('px', '');
    let video_altura = video_largura / ratio;
    video.style.height = `${video_altura}px`;
}
setInterval(updateArea, 100);

buttonDuvida.addEventListener("click", function(){
    window.alert('duvida enviada com sucesso!')});

function async(){

}

ButtonMarcarAula.addEventListener("click", async function(){
    let id = ButtonMarcarAula.getAttribute('data-id');

    ButtonMarcarAula.style.display='none';

    await fetch("/mvc/ajax/marcar_assistido/"+id);
});