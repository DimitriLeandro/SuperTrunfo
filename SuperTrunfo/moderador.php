<?php
	//conexão
	$link = new mysqli("localhost","root","root","db_super_trunfo");
	if ($link->connect_errno)
	{
		echo "Erro ao conectar com o Banco de Dados"; 
	}
	
	
	//SORTEANDO AS CARTAS AS CARTAS
	if(isset($_GET['sortear']))
	{
		$stmt = $link->prepare("DELETE FROM tb_jogador_carta WHERE cd_jogador > ?;");
		$stmt->bind_param("i", $zero = 0);
		$stmt->execute();
				
		if($stmt->affected_rows == 0)
		{
			echo "ERRO AO DELETAR CARTAS ANTIGAS";
		}
		
		$cartas = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
		shuffle($cartas);
		
		$cont_qtd = 1;
		$jogador = 1;
		
		foreach($cartas as $value)
		{
			$stmt = $link->prepare("INSERT INTO tb_jogador_carta VALUES (?, ?);");
			$stmt->bind_param("ii", $jogador, $value);
			$stmt->execute();
				
			if($stmt->affected_rows == 0)
			{
				echo "ERRO AO SORTEAR CARTAS";
			}
			$cont_qtd++;
			if($cont_qtd == 6)
			{
				$jogador = 2;
			}
		}
	}
?>

<?php
	if(isset($_GET['vencedor_rodada']) && isset($_GET['cd_carta_a']) && isset($_GET['cd_carta_b']))
	{
		$stmt = $link->prepare("DELETE FROM tb_jogador_carta WHERE cd_carta = ? OR cd_carta = ?;");
		$stmt->bind_param("ii", $_GET['cd_carta_a'], $_GET['cd_carta_b']);
		$stmt->execute();
		
		if($_GET['vencedor_rodada'] == 0)
		{
			$stmt = $link->prepare("INSERT INTO tb_jogador_carta VALUES (?, ?), (?, ?);");
			$stmt->bind_param("iiii", $jogador_a = 1, $_GET['cd_carta_a'], $jogador_a = 2, $_GET['cd_carta_b']);
			$stmt->execute();
		}
		else
		{
			if($_GET['vencedor_rodada'] == 1)
			{
				$stmt = $link->prepare("INSERT INTO tb_jogador_carta VALUES (?, ?), (?, ?);");
				$stmt->bind_param("iiii", $jogador_a = 1, $_GET['cd_carta_a'], $jogador_a = 1, $_GET['cd_carta_b']);
				$stmt->execute();
			}
			else
			{
				$stmt = $link->prepare("INSERT INTO tb_jogador_carta VALUES (?, ?), (?, ?);");
				$stmt->bind_param("iiii", $jogador_a = 2, $_GET['cd_carta_a'], $jogador_a = 2, $_GET['cd_carta_b']);
				$stmt->execute();
			}
		}
	}
?>

<?php
	//PEGANDO A PRIMEIRA CARTA DO BARALHO PRA CADA UM 
	$select_carta_jogador_1 = $link->query("SELECT tb_jogador_carta.cd_carta, nm_carta, vl_att_a, vl_att_b, vl_att_c
												FROM tb_jogador_carta, tb_carta
													WHERE tb_jogador_carta.cd_carta = tb_carta.cd_carta
														AND cd_jogador = 1
															LIMIT 1;");
	$row_carta_jogador_1 = $select_carta_jogador_1->fetch_row();
	
	$select_carta_jogador_2 = $link->query("SELECT tb_jogador_carta.cd_carta, nm_carta, vl_att_a, vl_att_b, vl_att_c
												FROM tb_jogador_carta, tb_carta
													WHERE tb_jogador_carta.cd_carta = tb_carta.cd_carta
														AND cd_jogador = 2
															LIMIT 1;");
	$row_carta_jogador_2 = $select_carta_jogador_2->fetch_row();
?>

						<div id="id_carta_1" class="col-md-4 wel-grid">
							<h4 id="nome_1"><?php echo $row_carta_jogador_1[1]; ?></h4>
							<div class="wel1">
								<img id="imagem_1" src="images/tubarao/<?php echo $row_carta_jogador_1[0]; ?>.jpg" class="img-responsive" alt=""/>
							</div>
							<div id="atributos" style="text-align: left; padding-left: inherit; font-size: medium;">
								<p onclick="ativar_botao('btn_jogar_a'); atributo_selecionado = 1; $('p').css('color', '#999'); $(this).css('color', 'deeppink');" style="cursor:pointer">
									<b>Comprimento(m):</b> 
									<i id="att_1_a"><?php echo $row_carta_jogador_1[2]; ?></i> 
								</p>
								<p onclick="ativar_botao('btn_jogar_a'); atributo_selecionado = 2; $('p').css('color', '#999'); $(this).css('color', 'deeppink');" style="cursor:pointer">
									<b>Peso(Kg):</b> 
									<i id="att_2_a"><?php echo $row_carta_jogador_1[3]; ?></i> 
								</p>
								<p onclick="ativar_botao('btn_jogar_a'); atributo_selecionado = 3; $('p').css('color', '#999'); $(this).css('color', 'deeppink');" style="cursor:pointer">
									<b>Velocidade(Km/h):</b> 
									<i id="att_3_a"><?php echo $row_carta_jogador_1[4]; ?></i> 
								</p>
							</div>
							<br/>
							<button disabled id="btn_jogar_a" style=" border-style: none; width: 100%; height: 50px; background: #dddddd; color: white;" onclick="jogar();">Jogar</button>
						</div>
						
						
						<div id="id_carta_2" class="col-md-4 wel-grid">
							<h4 id="nome_2"><?php echo $row_carta_jogador_2[1]; ?></h4>
							<div class="wel1">
								<img id="imagem_2" src="images/tubarao/<?php echo $row_carta_jogador_2[0]; ?>.jpg" class="img-responsive" alt=""/>
							</div>
							<div id="atributos" style="text-align: left; padding-left: inherit; font-size: medium;">
								<p onclick="ativar_botao('btn_jogar_b'); atributo_selecionado = 1; $('p').css('color', '#999'); $(this).css('color', 'deeppink');" style="cursor:pointer">
									<b>Comprimento(m):</b> 
									<i id="att_1_b"><?php echo $row_carta_jogador_2[2]; ?></i> 
								</p>
								<p onclick="ativar_botao('btn_jogar_b'); atributo_selecionado = 2; $('p').css('color', '#999'); $(this).css('color', 'deeppink');" style="cursor:pointer">
									<b>Peso(Kg):</b> 
									<i id="att_2_b"><?php echo $row_carta_jogador_2[3]; ?></i> 
								</p>
								<p onclick="ativar_botao('btn_jogar_b'); atributo_selecionado = 3; $('p').css('color', '#999'); $(this).css('color', 'deeppink');" style="cursor:pointer">
									<b>Velocidade(Km/h):</b> 
									<i id="att_3_b"><?php echo $row_carta_jogador_2[4]; ?></i> 
								</p>
							</div>
							<br/>
							<button disabled id="btn_jogar_b" style=" border-style: none; width: 100%; height: 50px; background: #dddddd; color: white;" onclick="jogar();">Jogar</button>
						</div>
						
						
						<div class="clearfix"></div>
						
						
	<script>
		var codigo_x = '<?php echo $row_carta_jogador_1[0]; ?>';
		var nome_x = '<?php echo $row_carta_jogador_1[1]; ?>';
		var att_1_x = '<?php echo $row_carta_jogador_1[2]; ?>';
		var att_2_x = '<?php echo $row_carta_jogador_1[3]; ?>';
		var att_3_x = '<?php echo $row_carta_jogador_1[4]; ?>';
		
		var codigo_y = '<?php echo $row_carta_jogador_2[0]; ?>';
		var nome_y = '<?php echo $row_carta_jogador_2[1]; ?>';
		var att_1_y = '<?php echo $row_carta_jogador_2[2]; ?>';
		var att_2_y = '<?php echo $row_carta_jogador_2[3]; ?>';
		var att_3_y = '<?php echo $row_carta_jogador_2[4]; ?>';
	</script>