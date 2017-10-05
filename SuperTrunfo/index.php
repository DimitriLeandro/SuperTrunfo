
<!DOCTYPE html>
<html>
<head>
<title>Super Trunfo</title>
<!---->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<link href="css/owl.carousel.css" rel="stylesheet">
<!--for-mobile-apps-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:title" content="Vide" />
<meta name="keywords" content="Aquatic Life Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--//for-mobile-apps-->
<script src="js/jquery.min.js"></script>
<!---->
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
<!---->
</head>
<body>
			<div class="navigation">
				<div class="container">
					<div class="logo">
						<h1><a href="#">Super <span>Trunfo</span></a></h1>
					</div>
					<div class="navigation-right">
						<span class="menu"><img src="images/menu.png" alt=" " /></span>
						<nav class="link-effect-3" id="link-effect-3">
							<ul class="nav1 nav nav-wil">
								<li class="active"><a>JOGADOR 1</a></li>
								<li><a id="id_qtd_cartas_1">5 CARTAS</a></li>
								<li><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
								<li class="active"><a>JOGADOR 2</a></li>
								<li><a id="id_qtd_cartas_2">5 CARTAS</a></li>
							</ul>
						</nav>
							<!-- script-for-menu -->
								<script>
								   $( "span.menu" ).click(function() {
									 $( "ul.nav1" ).slideToggle( 300, function() {
									 // Animation complete.
									  });
									 });
								</script>
							<!-- /script-for-menu -->
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
	<!--banner-->
		<!--welcome-->
		<div class="content">
			<div class="welcome-w3">
				<div class="container">
					<div class="wel-grids" style="padding-left: 15%;">
						<div style="position: absolute; padding-left: 320px; padding-top: 200px; font-size: large;">
							SORTEANDO CARTAS...
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="alert_vencedor">
			<section style="padding: 5px;">
				<p id="id_vencedor_rodada">JOGADOR 1 VENCE!</p>
				<p><button id="btn_ok" onclick="btn_ok_onclick();">OK</button></p>
				<p><button id="btn_acabou" onclick="window.location.replace('index.php');">OK</button></p>
			</section>
		</div>
		<style>
			.alert_vencedor{
				    text-align: center;
					font-size: x-large;
					position: absolute;
					width: 35%;
					top: 49%;
					margin-left: 32%;
					background: #f5f5f5;
					border-radius: 25px;
					border: 2px solid #0aa571;
			}
		</style>
		
		<script src="js/bootstrap.min.js"></script>
		<script>
			var atributo_selecionado = 1;
			var jogador_da_vez = 1;
			var qtd_cartas_jogador_1 = 5;
			var qtd_cartas_jogador_2 = 5;
			var vencedor_rodada = 0; //0 é empate
			var atributo_jogador_a = 0;
			var atributo_jogador_b = 0;
			
			function btn_ok_onclick()
			{
				$(".alert_vencedor").hide();
				
				//verifica se já há um vencedor_rodada
				//se não houver recarrega o ajax
				
				if(qtd_cartas_jogador_1 == 0 || qtd_cartas_jogador_2 == 0)
				{
					$("#id_vencedor_rodada").text("O JOGADOR "+vencedor_rodada+" GANHOU O JOGO!");
					$("#btn_ok").hide();
					$("#btn_acabou").show();
					$(".alert_vencedor").show();
				}
				else
				{	
					$(".wel-grids").load("moderador.php?vencedor_rodada="+vencedor_rodada+"&cd_carta_a="+codigo_x+"&cd_carta_b="+codigo_y+"", function(){
						incognitar();
					});
				}
			}
		
			function jogar()
			{				
				//funções
				desincognitar();
				vencedor_rodada = verificar_vencedor();
				trocar_jogador_da_vez(vencedor_rodada);
				mudar_qtd_cartas();
				
				//trocando o texto
				if(vencedor_rodada == 0)
				{
					$("#id_vencedor_rodada").text("EMPATE!");
				}
				else
				{
					$("#id_vencedor_rodada").text("JOGADOR "+vencedor_rodada+" VENCE!");
				}
				
				//exibindo
				$(".alert_vencedor").fadeIn(2500);
				
				//desabilitando os botões
				$("#btn_jogar_a").attr("disabled", true);
				$("#btn_jogar_b").attr("disabled", true);
				$("#btn_jogar_a").css("background-color", "#dddddd");
				$("#btn_jogar_b").css("background-color", "#dddddd");
			}
		
			$(document).ready(function(){
				$(".alert_vencedor").hide();
				$("#btn_acabou").hide();				
				$(".wel-grids").load("moderador.php?sortear=true", function(){
					incognitar();
				});				
			});
			
			function mudar_qtd_cartas()
			{
				if(vencedor_rodada == 1)
				{
					qtd_cartas_jogador_1 = qtd_cartas_jogador_1 + 1;
					qtd_cartas_jogador_2 = qtd_cartas_jogador_2 - 1;
				}
				else
				{
					if(vencedor_rodada == 2)
					{
						qtd_cartas_jogador_1 = qtd_cartas_jogador_1 - 1;
						qtd_cartas_jogador_2 = qtd_cartas_jogador_2 + 1;
					}
				}
				
				$("#id_qtd_cartas_1").text(""+qtd_cartas_jogador_1+" CARTAS");
				$("#id_qtd_cartas_2").text(""+qtd_cartas_jogador_2+" CARTAS");
			}
			
			function trocar_jogador_da_vez(ven_rod)
			{
				if(ven_rod == 0)//empate
				{
					if(jogador_da_vez == 1)
					{
						jogador_da_vez = 2;
					}
					else
					{
						jogador_da_vez = 1;
					}
				}
				else
				{
					jogador_da_vez = ven_rod;
				}
			}
			
			function verificar_vencedor()
			{				
				switch(atributo_selecionado)
				{
					case 1:
						atributo_jogador_a = att_1_x;
						atributo_jogador_b = att_1_y;
					break;
					
					case 2:
						atributo_jogador_a = att_2_x;
						atributo_jogador_b = att_2_y;
					break;
					
					case 3:
						atributo_jogador_a = att_3_x;
						atributo_jogador_b = att_3_y;
					break;
					
					default:
						atributo_jogador_a = att_1_x;
						atributo_jogador_b = att_1_y;
					break;
				}
				
				atributo_jogador_a = atributo_jogador_a * 1;
				atributo_jogador_b = atributo_jogador_b * 1;
				
				if(atributo_jogador_a == atributo_jogador_b)
				{
					return '0';
				}
				else 
				{
					if(atributo_jogador_a > atributo_jogador_b)
					{
						return '1';
					}
					else
					{
						return '2';
					}
				}
			}
			
			function desincognitar()
			{
				if(jogador_da_vez == 1)
				{
					$("#id_carta_2").fadeOut(function(){
						$("#nome_2").text(nome_y);
						$("#att_1_b").text(att_1_y);
						$("#att_2_b").text(att_2_y);
						$("#att_3_b").text(att_3_y);
						$("#imagem_2").attr("src", "images/tubarao/"+codigo_y+".jpg");
						$("#id_carta_2").fadeIn();
					});
				}
				else
				{
					$("#id_carta_1").fadeOut(function(){
						$("#nome_1").text(nome_x);
						$("#att_1_a").text(att_1_x);
						$("#att_2_a").text(att_2_x);
						$("#att_3_a").text(att_3_x);
						$("#imagem_1").attr("src", "images/tubarao/"+codigo_x+".jpg");
						$("#id_carta_1").fadeIn();
					});
				}
			}
			
			function incognitar()
			{
				if(jogador_da_vez == 2)
				{
					$("#nome_1").text("???");
					$("#att_1_a").text("???");
					$("#att_2_a").text("???");
					$("#att_3_a").text("???");
					$("#imagem_1").attr("src", "images/incognita.png");
				}
				else
				{
					$("#nome_2").text("???");
					$("#att_1_b").text("???");
					$("#att_2_b").text("???");
					$("#att_3_b").text("???");
					$("#imagem_2").attr("src", "images/incognita.png");
				}
			}
			
			function ativar_botao(botao)
			{
				var btn = "#"+botao+"";
				$(btn).attr("disabled", false);
				$(btn).css("background-color", "#17c2a4");
			}
		</script>
</body>
</html>
