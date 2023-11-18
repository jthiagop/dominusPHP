<?php
@session_start();
require_once('../conexao.php');
require_once('verificar.php');
$id_usuario = @$_SESSION['id_usuario'];

//Trazer dados do usuário logado
$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = $res[0]['nome'];
$cpf_usu = $res[0]['cpf'];
$email_usu = $res[0]['email'];
$senha_usu = $res[0]['senha'];
$nivel_usu = $res[0]['nivel'];
$foto_usu = $res[0]['foto'];

$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);


//MENU DO PAINEL
$pag = @$_GET['pag'];
if ($pag == '') {
	$pag = 'home';
}

?>
<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title><?php echo $nome_organismo ?></title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />


	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css" />
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css" />
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css" />

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258" crossorigin="anonymous"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag("js", new Date());

		gtag("config", "G-GBZ3SGGX85");
	</script>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				"gtm.start": new Date().getTime(),
				event: "gtm.js"
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != "dataLayer" ? "&l=" + l : "";
			j.async = true;
			j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
	</script>
	<!-- End Google Tag Manager -->
</head>

<body>
	<div class="header">
		<!-- Barra de Busca -->
		<div class="header-left">
			<div class="menu-icon bi bi-list"></div>
			<div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here" />
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text" />
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- Fim da Barra de Busca -->
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>

			<div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="../vendors/images/img.jpg" alt="" />
										<h3>John Doe</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="../vendors/images/photo1.jpg" alt="" />
										<h3>Lea R. Frith</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="../vendors/images/photo2.jpg" alt="" />
										<h3>Erik L. Richards</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="../vendors/images/photo3.jpg" alt="" />
										<h3>John Doe</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="../vendors/images/photo4.jpg" alt="" />
										<h3>Renee I. Hansen</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="../vendors/images/img.jpg" alt="" />
										<h3>Vicki M. Coleman</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="../src/images/membros/<?php echo @$foto_usu ?>" alt="" class=""/>
						</span>
						<span class="user-name"><?php echo $nome_usu ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="#" data-backdrop="static" data-toggle="modal" data-target="#exampleModal"><i class="dw dw-settings2"></i> Editar</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Ajuda</a>
						<a class="dropdown-item" href="../logout.php"><i class="dw dw-logout"></i> Sair</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">
						Reset Settings
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<img src="../vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
				<img src="../vendors/images/deskapp-logo-white.svg" alt="" class="light-logo" />
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="index.php" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-house"></span><span class="mtext">Início</span>
						</a>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon icon-copy bi bi-people"></span>
							<span class="mtext">Pessoas</span>
						</a>
						<ul class="submenu">
							<li><a href="index.php?pag=admins">Administrador</a></li>
							<li><a href="index.php?pag=frades">Frades</a></li>
							<li><a href="index.php?pag=secretarios">Secretarios</a></li>
							<li><a href="index.php?pag=tesoureiros">Tesoureiros</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>


	<!-- js -->
	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="jquery.dataTables.min.js"></script>
	<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>

	<!-- Mascara para cpf cnpj telefone -->
	<!-- Mascara para cpf cnpj telefone -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
	<script src="../src/scripts/mascaras.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>


	<!-- buttons for Export datatable -->
	<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
	<!-- Datatable Setting js -->

	<script src="../src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<div class="main-container">
		<div class="xs-pd-20-10 pd-ltr-20">
			<?php
			require_once($pag . '.php');
			?>
		</div>
	</div>
</body>

</html>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="text-primary" id="exampleModalLabel">Editar Dados</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-usu" method="post">
					<small>
						<div id="msg-usu"></div>
					</small>
					<div class="row">
						<div class="col-md-3 col-sm-12">
							<div class="profile-photo" id="divImg">
								<img src="../src/images/membros/<?php echo @$foto_usu ?>" id="target-usu" alt="Foto de Perfil" class=" my-2 profile-photo avatar-photo img-thumbnail" />
								<input type="file" class="form-control-file" id="imagem-usu" name="imagem" onChange="carregarImg2();">
							</div>
						</div>
						<div class="col-md-9 col-sm-12">
							<div class="row">
								<input type="hidden" name="id_usu" value="<?php echo $id_usuario ?>">
								<div class="col-sm-12">
									<div class="input-group custom">
										<input type="text" id="nome_usu" name="nome_usu" class="form-control form-control-lg" placeholder="Nome" value="<?php echo $nome_usu ?>" required />
										<div class="input-group-append custom">
											<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-group custom">
										<input type="text" id="cpf_usu" name="cpf_usu" class="form-control form-control-lg" placeholder="Digite o CPF" value="<?php echo $cpf_usu ?>" required />
										<div class="input-group-append custom">
											<span class="input-group-text"><i class="icon-copy bi bi-card-text"></i></i></span>
										</div>
									</div>
								</div>

								<div class="col-sm-12">
									<div class="input-group custom">
										<input type="email" id="email_usu" name="email_usu" class="form-control form-control-lg" placeholder="name@exemple.com.br" value="<?php echo $email_usu ?>" required />
										<div class="input-group-append custom">
											<span class="input-group-text">
												<i class="icon-copy bi bi-envelope"></i>
											</span>
										</div>
									</div>
								</div>

								<div class="col-sm-12">
									<div class="input-group custom">
										<input type="senha" id="senha_usu" name="senha_usu" class="form-control form-control-lg" placeholder="Digite a senha" value="<?php echo $senha_usu ?>" required />
										<div class="input-group-append custom">
											<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
										</div>
									</div>
								</div>


							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-fechar-usu">Sair</button>
							<button type="submit" class="btn btn-primary">Salvar</button>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Script de Inserção -->
<script type="text/javascript">
	$("#form-usu").submit(function() {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-dados.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#msg-usu').text('');
				$('#msg-usu').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {

					$('#btn-fechar-usu').click();
					window.location = "index.php";
				} else {

					$('#msg-usu').addClass('text-danger')
					$('#msg-usu').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>
<!-- Fim de Script de Inserção -->