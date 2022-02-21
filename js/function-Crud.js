function apagar(id){
    var id = id;
    var conteudo = `  
    <table>
    <tr><td colspan='2'><h6>Após deletar a entrada não será possível recuperá-la<br>Deseja mesmo prosseguir?</h6></td></tr>
    <tr><td><a onclick='sim(`+ id +`)'>sim</a></td><td><a onclick='nao()'>não</a></td></tr>
    </table>
    `;
    document.getElementById(id).innerHTML = conteudo;

}
function editar(id, titulo, genero, autor, npaginas, finalizado, feedback, opinion){
    var id = id;
    var npaginas = npaginas;
    var titulo = titulo;
    var genero = genero;
    var autor = autor;
    var pg = npaginas;
    var finalizado = finalizado;
    if (finalizado == "1"){
        var check = "<td colspan='2'><div class='finalizado'><input type='radio' id='yes' name='finalizado_edit' value='1' checked><label for='yes'>Sim </label><input type='radio' id='no' name='finalizado_edit' value='0'><label for='no'>Não</label><div></td>";
    } else {var check = "<td colspan='2'><div class='finalizado'><input type='radio' id='yes' name='finalizado_edit' value='1'><label for='yes'>Sim </label><input type='radio' id='no' name='finalizado_edit' value='0' checked><label for='no'>Não</label><div></td>";}
    var feedback = feedback;
    switch(feedback){
        case(0): 
            var rate = "<td colspan='3'><div class='rating'><input type='radio' name='feedback' id='rating-5' value='5'><label for='rating-5'></label><input type='radio' name='feedback' id='rating-4' value='4'><label for='rating-4'></label><input type='radio' name='feedback' id='rating-3' value='3'><label for='rating-3'></label><input type='radio' name='feedback' id='rating-2' value='2'><label for='rating-2'></label><input type='radio' name='feedback' id='rating-1' value='1'><label for='rating-1'></label></div></td>";
        break;
        case(1):
        var rate = "<td colspan='3'><div class='rating'><input type='radio' name='feedback' id='rating-5' value='5'><label for='rating-5'></label><input type='radio' name='feedback' id='rating-4' value='4'><label for='rating-4'></label><input type='radio' name='feedback' id='rating-3' value='3'><label for='rating-3'></label><input type='radio' name='feedback' id='rating-2' value='2'><label for='rating-2'></label><input type='radio' name='feedback' id='rating-1' value='1'  checked><label for='rating-1'></label></div></td>";
        break;
        case(2):
        var rate = "<td colspan='3'><div class='rating'><input type='radio' name='feedback' id='rating-5' value='5'><label for='rating-5'></label><input type='radio' name='feedback' id='rating-4' value='4'><label for='rating-4'></label><input type='radio' name='feedback' id='rating-3' value='3'><label for='rating-3'></label><input type='radio' name='feedback' id='rating-2' value='2'  checked><label for='rating-2'></label><input type='radio' name='feedback' id='rating-1' value='1'><label for='rating-1'></label></div></td>";
        break;
        case(3):
        var rate = "<td colspan='3'><div class='rating'><input type='radio' name='feedback' id='rating-5' value='5'><label for='rating-5'></label><input type='radio' name='feedback' id='rating-4' value='4'><label for='rating-4'></label><input type='radio' name='feedback' id='rating-3' value='3' checked><label for='rating-3'></label><input type='radio' name='feedback' id='rating-2' value='2'><label for='rating-2'></label><input type='radio' name='feedback' id='rating-1' value='1'><label for='rating-1'></label></div></td>";
        break;
        case(4):
        var rate = "<td colspan='3'><div class='rating'><input type='radio' name='feedback' id='rating-5' value='5'><label for='rating-5'></label><input type='radio' name='feedback' id='rating-4' value='4'  checked><label for='rating-4'></label><input type='radio' name='feedback' id='rating-3' value='3'><label for='rating-3'></label><input type='radio' name='feedback' id='rating-2' value='2'><label for='rating-2'></label><input type='radio' name='feedback' id='rating-1' value='1'><label for='rating-1'></label></div></td>";
        break;
        case(5):
        var rate = "<td colspan='3'><div class='rating'><input type='radio' name='feedback' id='rating-5' value='5'  checked><label for='rating-5'></label><input type='radio' name='feedback' id='rating-4' value='4'><label for='rating-4'></label><input type='radio' name='feedback' id='rating-3' value='3'><label for='rating-3'></label><input type='radio' name='feedback' id='rating-2' value='2'><label for='rating-2'></label><input type='radio' name='feedback' id='rating-1' value='1'><label for='rating-1'></label></div></td>";
        break;
    }
    var opinion = opinion;
    document.getElementById(id).innerHTML = `
        <form action='edita.php?id=`+id+`' method='post'> 
        <table> 
        <tr><td colspan='3'><input type='text' autocomplete='off' name='titulo' id='titulo_livro' value='`+titulo+`'/></td></tr> 
        <tr><td><p>Gênero: </p></td><td colspan='2'><input type='text' autocomplete='off' name='genero' class='edit' value='`+genero+`'/></td></tr> 
        <tr><td><p>Autor: </p></td><td colspan='2'><input type='text' autocomplete='off' name='autor' class='edit' value='`+autor+`'/></td></tr> 
        <tr><td><p>Páginas lidas: </p></td><td colspan='2'><input type='number' autocomplete='off' name='nPaginas' id='nPaginas' value='`+pg+`'/></td></tr> 
        <tr><td><p>Finalizado? </p></td>`+check+`</tr>
        <tr>`+rate+`</tr>
        <tr><td colspan='3'><textarea name='descricao' id='critica'>`+opinion+`</textarea></td></tr>
        <tr><td><button type='submit'><img src='../ícones/salvar.png' class='acao' title='salvar'></button></td><td><img src='../ícones/voltar.png' class='acao' title='voltar' onclick='voltar()'></td></tr> 
        </table> 
        </form> 
        `;
}
function nao(){
    location.reload();
}
function sim(id){
    var id = id;
    var caminho = "apaga.php?id=" + id;
    window.location.replace(caminho);
}

function voltar(){
    location.reload();
}
function descricao(id, titulo, descricao){
    var id = id;
    var titulo = titulo;
    var descricao = descricao;
    var conteudo = `  
    <table>
    <tr><td colspan='2'><h5>Sobre `+ titulo +`</h5></td></tr>
    <tr><td colspan='2'><h6>"`+ descricao +`"</h6></td></tr>
    <tr><td><img src='../ícones/voltar.png' class='acao' title='voltar' onclick='voltar()' style='transform: rotate(180deg);'></td><td></td></tr> 
    </table>
    `;
    document.getElementById(id).innerHTML = conteudo;
}