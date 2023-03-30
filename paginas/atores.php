<?php

    if ( $id <= 0 ) {
        //echo "<script>alert('Página Inválida');history.back();</script>";
        //exit;
        $id = 1;
    }

    $link = "https://api.themoviedb.org/3/person/popular?api_key={$key}&language=pt-BR&page={$id}";

    //echo $link;

    $link = file_get_contents($link);
    $dados = json_decode($link);
    //print_r($dados);
?>
<h1 class="text-center">Atores Populares</h1>
<div class="row">
    <?php
        //retirar os dados do results do json
        foreach ( $dados->results as $ator ) {

            if ( empty ( $ator->profile_path ) ) {
                $imagem = "imagens/semfoto.jpg";
            } else {
                $imagem = $pasta . $ator->profile_path;
            }

            ?>
            <div class="col-12 col-md-3">
                <div class="card text-center">

                    <img src="<?=$imagem?>" class="w-100">

                    <p><?=$ator->name?></p>

                    <p>
                        <a href="ator/<?=$ator->id?>" class="btn btn-warning">
                            Detalhes do Ator
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
        location.href = "atores/"+pagina;
    }
</script>