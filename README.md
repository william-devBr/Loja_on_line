# Loja_on_line com PHP, Js, Css
Projeto de loja online com carrinho de compras desenvolvido no padrão MVC com PHP, Js, Css


======================================================

Projeto básico desenvolvido com PHP utilizando Javascript e Css.

Banco de dados de Loja Virtual com carrinho de compras.

Projeto ainda em desenvolvimento e sendo aprimorado

arquivo "config.php" necessita alterar o conteúdo das
varáveis globais.


Necessário Criar a Database para rodar o projeto.
#/DATABASE
===========   LEIA-ME ================
#raiz do projeto criar a pasta config com as informarções da base de dados

#criar as pastas:
    core/
          controllers/
          views/
                layouts/
          classes/
     public/
          assets/
                   css/
                    js/
     index.php

#arquitetura do autoad no composer.json
 "autoload": {
        "psr-4": {
             /*namespaces do projeto */
            "core\\" : "core/"
        }
    }

#criar via composer a pasta vendor para carregar o autoload.php
#criar as classes Database / Main/ Function definindo os namespace

 # toda alteração no composer tem que rodar no terminal o comando "composer update"
incluído arquivo config via composer
 "files" : [
            "config.php"
        ]

================================================


