<?php
require_once('../conexao.php');
require_once('verificar.php');
$pagina = 'tesoureiros';
?>

<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tesoureiros
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a class="btn btn-primary icon-copy bi bi-person-plus-fill" href="#" type="button" onclick="inserir()" data-toggle="modal" data-target="#modalForm">
                        Novo Tesoureiros
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $query = $pdo->query("SELECT * FROM $pagina order by nome asc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = count($res);
    if ($total_reg > 0) {
    ?>
        <div class="min-height-200px">
            <!-- Simple Datatable Simples -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Registro de Tesoureiros</h4>
                </div>
                <div class="pb-20">
                    <table id="administradores" class="data-table table stripe hover nowrap">
                        <thead>

                            <tr>
                                <th class="table-plus datatable-nosort">Nome</th>
                                <th>E-mail </th>
                                <th>CPF</th>
                                <th>Endereço</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < @count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }

                                $nome = $res[$i]['nome'];
                                $email = $res[$i]['email'];
                                $cpf = $res[$i]['cpf'];
                                $endereco = $res[$i]['endereco'];
                                $telefone = $res[$i]['telefone'];
                                $foto = $res[$i]['foto'];
                                $data_nasc = $res[$i]['data_nasc'];
                                $data_cad = $res[$i]['data_cad'];
                                $id = $res[$i]['id'];

                                $data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));
                                $data_cadF = implode('/', array_reverse(explode('-', $data_cad)));

                            ?>
                                <tr>
                                    <td>
                                        <div class="name-avatar d-flex align-items-center">
                                            <div class="avatar mr-2 flex-shrink-0">
                                                <img src="../src/images/membros/<?php echo $foto ?>" class="border-radius-100 shadow border border-primary" width="40" height="40" alt="" />
                                            </div>
                                            <div class="txt">
                                                <div class="weight-600"><?php echo $nome ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $email ?></td>
                                    <td><?php echo $cpf ?></td>
                                    <td><?php echo $endereco ?></td>
                                    <td><?php echo $telefone ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="#" onclick="editar(
                                                    '<?php echo $id ?>', 
                                                    '<?php echo $nome ?>', 
                                                    '<?php echo $email ?>', 
                                                    '<?php echo $cpf ?>', 
                                                    '<?php echo $telefone ?>', 
                                                    '<?php echo $endereco ?>',
                                                    '<?php echo $foto ?>',
                                                    '<?php echo $data_nasc ?>',                                            
                                                    )" title="Editar Registro"><i class="dw dw-edit2" data-color="#265ed7"></i></a>
                                            <a href="#" onclick="excluir('<?php echo $id ?>', '<?php echo $nome ?>')" title="Excluir Registro"><i class="dw dw-delete-3" data-color="#e95959"></i> </a>
                                            <a href="#" onclick="dados(
                                                    '<?php echo $nome ?>',
                                                    '<?php echo $email ?>', 
                                                    '<?php echo $cpf ?>', 
                                                    '<?php echo $telefone ?>', 
                                                    '<?php echo $endereco ?>',
                                                    '<?php echo $foto ?>',
                                                    '<?php echo $data_nascF ?>',
                                                    '<?php echo $data_cadF ?>',
                                                    )" title="Ver Registro"><text-info class="icon-copy bi bi-info-circle text-info"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->
        </div>

    <?php
    } else {
        echo 'Não existem dados cadastrados';
    }
    ?>
    <div class="footer-wrap pd-20 mb-20 card-box">
        2023 &copy; Dominus Sistema de Automação - Todos os direitos reservados - v1.0.1.03
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-primary" id="tituloModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="post">
                    <small>
                        <div id="mensagem"></div>
                    </small>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="profile-photo" id="divImg">
                                <img src="../src/images/membros/<?php echo $foto ?>" id="target" alt="Foto de Perfil" class=" my-2 profile-photo avatar-photo img-thumbnail" />
                                <input type="file" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div class="row">
                                <div class="col-md-7 col-sm-12">
                                <label>Nome: </label>
                                    <div class="input-group custom">
                                        <input type="text" id="nome" name="nome" class="form-control form-control-lg" placeholder="Nome e Sobrenome" required />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                <label>CPF</label>
                                    <div class="input-group custom">
                                        <input type="text" id="cpf" name="cpf" class="form-control form-control-lg" placeholder="Informe o CPF" required />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy bi bi-card-text"></i></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-sm-12">
                                <label>E-mail</label>
                                    <div class="input-group custom">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="name@exemple.com.br" required />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy bi bi-envelope"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5 col-sm-12">
                                <label>Telefone:</label>
                                    <div class="input-group custom">
                                        <input type="telefone" id="telefone" name="telefone" class="form-control form-control-lg" placeholder="Telefone" required />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy bi bi-telephone-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-sm-12">
                                <label>Endereço:</label>
                                    <div class="input-group custom">
                                        <input type="text" id="endereco" name="endereco" class="form-control form-control-lg" placeholder="Digite o Endereço" required />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy fa fa-map-o" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <label>Nascimento: </label>
                                    <div class="input-group custom">
                                        <input type="date" id="data_nasc" name="data_nasc" value="<?php echo date('Y-m-d') ?>" class="form-control form-control-lg"required />
                                    </div>
                                </div>
                                <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-fechar">Sair</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-danger text-white">
            <form id="form-excluir" method="post">
                <div class="modal-body text-center">
                    <h3 class="text-white mb-15">
                        <i class="fa fa-exclamation-triangle"></i> ATENÇÂO
                    </h3>
                    <p>
                        voce está preste a excluir um usuário! Deseja realmente excluir este registro: <span class="font-weight-bold" id="nome-excluido"></span>?
                    </p>

                    <small>
                        <div id="mensagem-excluir"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-excluir" id="id-excluir">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-fechar-excluir">
                        Não
                    </button>
                    <button type="submit" class="btn btn-light">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="login-box bg-white box-shadow border-radius-10">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                ×
            </button>
            <h4 class="text-center text-primary">
                Informações de Registro
            </h4>
            <div class="modal-body pd-5">
                <div class="profile-photo" id="divImg">
                    <img src="../src/images/membros/<?php echo $foto ?>" id="foto-dados" alt="Foto de Perfil" class=" my-2 profile-photo avatar-photo img-thumbnail" width="500px" />
                </div>
            </div>
            <form>
                <h5 class="text-center h5 mb-0" id="nome-dados"></h5>
                <p class="text-center text-muted font-14">
                    Lorem ipsum dolor sit amet
                </p>
                <div class="profile-info">
                    <ul>
                        <div class="row">
                            <li class="col-md-6 col-sm-12">
                                <span>Email:</span>
                                <p class="text-muted mb-0" id="email-dados"></p>
                            </li>
                            <li class="col-md-6 col-sm-12">
                                <span>Telefone:</span>
                                <p class="text-muted mb-0" id="telefone-dados"></p>
                            </li>
                        </div>
                        <div class="row">
                            <li class="col-md-6 col-sm-12">
                                <span>CPF:</span>
                                <p class="text-muted mb-0" id="cpf-dados"></p>
                            </li>
                            <li class="col-md-6 col-sm-12">
                                <span>Endereço:</span> 
                                    <p class="text-muted mb-0" id="endereco-dados"></p>
                            </li>
                        </div>
                        <div class="row">
                            <li class="col-md-6 col-sm-12">
                                <span>Nascimento:</span>
                                <p class="text-muted mb-0" id="data_nasc"><?php echo $data_nascF ?></p>
                            </li>
                            <li class="col-md-6 col-sm-12">
                                <span>Cadastro:</span> 
                                    <p class="text-muted mb-0" id="data_cad"><?php echo $data_cad ?></p>
                            </li>
                        </div>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-0">
                            <!--
																use code for form submit
																<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
															-->
                            <button class="btn btn-primary btn-lg btn-block">Sair</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    var pag = "<?= $pagina ?>"
</script>
<script src="../src/scripts/ajax.js"></script>

<script type="text/javascript">
    function editar(id, nome, email, cpf, telefone, endereco, foto, data_nasc) {
        $('#id').val(id);
        $('#nome').val(nome);
        $('#email').val(email);
        $('#cpf').val(cpf);
        $('#telefone').val(telefone);
        $('#endereco').val(endereco);
        $('#data_nasc').val(data_nasc);
        $('#target').attr('src', '../src/images/membros/' + foto);


        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }

    function dados(nome, email, cpf, telefone, endereco, foto, data_nasc, data_cad) {
        $('#nome-dados').text(nome);
        $('#email-dados').text(email);
        $('#cpf-dados').text(cpf);
        $('#telefone-dados').text(telefone);
        $('#endereco-dados').text(endereco);
        $('#data_cad').text(data_cad);
        $('#foto-dados').attr('src', '../src/images/membros/' + foto);

        var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {});
        myModal.show();
        $('#mensagem').text('');
    }
</script>