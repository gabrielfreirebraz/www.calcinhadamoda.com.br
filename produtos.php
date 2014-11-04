<!DOCTYPE html>
<!--

-->
<html>
    <head>
        <title>..::CALCINHA DA MODA::..</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="css/normalize.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/calcinhadamoda.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
        <?php include "./includes/topo.html" ?>
        
        <div id="content_1">
            <?php include "./includes/menu.html" ?>
        
            
            
            <div id="produtos">
                <!-- Modal - display:none -->
                <?php include "./produto-det.html" ?>
                
                <h2>Conheça nossos produtos</h2>
                
                <!-- Load XML com ajax -->
                <ul>
<!--                    <li>
                        <a href='#'>
                            <img src='images/produtos/prod1.jpg' alt=''/>
                            <label>Calcinha bla bla</label>
                            <p>Calcinha moderna e muito top, por apenas:</p>
                            <span>R$ 19,99</span>
                        </a>
                    </li>    -->
                </ul>
                
                
            </div>
        </div>
        
        
        <?php include "./includes/rodape.html" ?>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript">
            
            
            
            $('#upArrow').on("click", function (e) {
                e.preventDefault();
                $('html, body').animate({scrollTop: '0'}, 1000);
            });
            
            
            
            
            var loadProdutos = {                
                
                init: function (){
                    
                    this.loadAll();
                },                
                loadAll: function (){
                    
                    var me = this;
                    $.ajax({
                        type: "GET",
                        url: "xml/produtos.xml",
                        dataType: "xml",
                        
                        beforeSend: function( xhr ) {

                        },  
                        success: function (xml) {
                            
                            //
                            // Carregar todos os produtos
                            //
                            me.loadAllProd(xml);
                        },                                              
                        error: function () {
                            alert("Erro inesperado durante o processamento.");
                        },
                        complete: function (){
                            
                            //
                            // Carregar detalhe do produto no modal
                            //
                            me.clickProdModal();
                        }
                    });                    
                },
                
                loadAllProd: function (xml){                    
                    $(xml).find('produtos item').each(function () {

                        var imagem = $(this).find("imagem").text();
                        var nome = $(this).find("nome").text();
                        var descricao = $(this).find("descricao").text();
                        var preco = $(this).find("preco").text();

                        var ul = $("#produtos ul");

                        ul.append(
                                "<li>"+
                                    "<a href='#'>"+
                                        "<img src='"+imagem+"' alt=''/>"+
                                        "<label>"+nome+"</label>"+
                                        "<p>"+descricao+"</p>"+
                                        "<span>"+preco+"</span>"+
                                    "</a>"+
                                "</li>"
                            );

                    });
                },
                clickProdModal: function (){ 
                   
                    $("a", "#produtos").on("click", function (){
                        var nomeProduto = $(this).children("label").text();
                        var htmlProduto = $(this).html();
                        
                        $("html, body").animate({
                            scrollTop: $("#menu").offset().top
                            
                        }, "slow", function (){                                
                            $(".modal-title", "#modal").html(nomeProduto);
                            $(".modal-body", "#modal").html(htmlProduto);
                            
                            $('#modal').modal();                            
                        });
                    });
                }
            };
           
         
            //
            // INICIAR LOAD DE PRODUTOS
            //
            loadProdutos.init();
        </script>
    </body>

</html>
