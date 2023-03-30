<h1 class="text-center">
    Últimos Filmes
</h1>
<div class="row">
<?php

    if ( $id <= 0 ) {
        //echo "<script>alert('Página Inválida');history.back();</script>";
        //exit;
        $id = 1;
    }
    
    $link = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key={$key}&language=pt-BR&page={$id}");
    
    $dados = json_decode($link);

    //print_r ( $dados );
    foreach ( $dados->results as $filme ) {

        //echo $filme->title."<br>";
        ?>
        <div class="col-12 col-md-3">
            <div class="card text-center">
                <img src="<?=$pasta?><?=$filme->poster_path?>"
                alt="<?=$filme->title?>" class="w-100">
                <p class="titulo"><?=$filme->title?></p>
                <p>
                    <a href="filme/<?=$filme->id?>" class="btn btn-warning">
                        Detalhes do Filme
                    </a>
                </p>
            </div>
        </div>
        <?php
        
    }
    //pegar total de páginas desta seleção
    echo "Total de páginas: " . $pg = $dados->total_pages;

    if ( $id > $pg ) {
        echo "<script>alert('Página inválida');history.back();</script>";
        exit;
    }
?>
</div>

<a href="atores/1" class="btn btn-default">
    << Primeira Página
</a>

<input type="number" name="pagina" id="Pagina" class="form-control"
placeholder="1 a <?=$pg?>" style="width: 100px" 
onblur="mudaPagina(this.value)">

<a href="atores/<?=$pg?>" class="btn btn-default">
    Última Página >>
</a>

<script>
    function mudaPagina(pagina) {
        location.href = "filmes/"+pagina;
    }
</script>