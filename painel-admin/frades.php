<?php
require_once('../conexao.php');
require_once('verificar.php');
$pagina = 'frades';
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
                            Frades
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a class="btn btn-primary icon-copy bi bi-person-plus-fill" href="#" type="button" onclick="inserir()" data-toggle="modal" data-target="#modalForm">
                        Novo Frade
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
                    <h4 class="text-blue h4">Registro de Frades</h4>
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
                                $id = $res[$i]['id'];
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
                                                    )" title="Editar Registro"><i class="dw dw-edit2" data-color="#265ed7"></i></a>
                                            <a href="#" onclick="excluir('<?php echo $id ?>', '<?php echo $nome ?>')" title="Excluir Registro"><i class="dw dw-delete-3" data-color="#e95959"></i> </a>
                                            <a href="#" onclick="dados(
                                                    '<?php echo $nome ?>',
                                                    '<?php echo $email ?>', 
                                                    '<?php echo $cpf ?>', 
                                                    '<?php echo $telefone ?>', 
                                                    '<?php echo $endereco ?>',
                                                    '<?php echo $foto ?>',
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
                        <div class="col-3">
                            <div class="profile-photo" id="divImg">
                                <img src="../src/images/membros/<?php echo $foto ?>" id="target" alt="Foto de Perfil" class=" my-2 profile-photo avatar-photo img-thumbnail" />
                                <input type="file" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-7">
                                    <div class="input-group custom">
                                        <input type="text" id="nome" name="nome" class="form-control form-control-lg" placeholder="Digite o Nome" required />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group custom">
                                        <input type="text" id="cpf" name="cpf" class="form-control form-control-lg" placeholder="Digite o CPF" required />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy bi bi-card-text"></i></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="input-group custom">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="name@exemple.com.br" required />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy bi bi-envelope"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5">
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
                                <div class="col-12">
                                    <div class="input-group custom">
                                        <input type="text" id="endereco" name="endereco" class="form-control form-control-lg" placeholder="Digite o Endereço" required />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy fa fa-map-o" aria-hidden="true"></i></span>
                                        </div>
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


<div class="modal fade bs-example-modal-lg" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Informações de Registro
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Nome Completo: </p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="nome-dados"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">E-mail: </p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="email-dados"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Telefone : </p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="telefone-dados"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">CPF :</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="cpf-dados"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Endereço :</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="endereco-dados"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Sair
                </button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var pag = "<?= $pagina ?>"
</script>
<script src="../src/scripts/ajax.js"></script>

<script type="text/javascript">
    function editar(id, nome, email, cpf, telefone, endereco, foto) {
        $('#id').val(id);
        $('#nome').val(nome);
        $('#email').val(email);
        $('#cpf').val(cpf);
        $('#telefone').val(telefone);
        $('#endereco').val(endereco);
        $('#target').attr('src', '../src/images/membros/' + foto);


        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }

    function dados(nome, email, cpf, telefone, endereco, foto) {
        $('#nome-dados').text(nome);
        $('#email-dados').text(email);
        $('#cpf-dados').text(cpf);
        $('#telefone-dados').text(telefone);
        $('#endereco-dados').text(endereco);

        var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {});
        myModal.show();
        $('#mensagem').text('');
    }
</script>