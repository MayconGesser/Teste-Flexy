<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistema de cálculo de fretes</title>
        <script>
            var url = 'http://localhost/Teste-Flexy/';
            var rotas = {
                'tr': 'transportadora/',
                'fe': 'faixa_entrega/'
            };
        </script>
    </head>
    <body>
        <h1>Bem-vindo ao sistema de cálculo de fretes</h1>
        <br><br>
        <h2>O que deseja fazer?</h2>
        <br><br>
        <div id="botoes">
            <button type="button" class="tr" value="cadastro_transportadoras.html">Cadastrar Transportadora</button>
            <button type="button" class="tr" value="CRUD_transportadora.html">Listar Transportadoras</button><br><br>
            <button type="button" class="fe" value="cadastro_faixa_entrega.html">Cadastrar Faixa de Entrega</button>
            <button type="button" class="fe" value="CRUD_faixa_entrega.html">Listar Faixas de Entrega</button><br><br>
        </div>
        <script>
            var botoes = document.getElementsByTagName('button');
            console.log(botoes);
            for (var i = 0; i < botoes.length; i++) {
                console.log(botoes[i]);
                botoes[i].addEventListener('click', function () {
                    this.value = rotas[this.className] + this.value;
                    window.location.href = url + this.value;
                });
            }
        </script>
    </body>
</html>