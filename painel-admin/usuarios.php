<?php
require_once('../conexao.php');
require_once('verificar.php');
$pagina = 'usuarios';
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
                                <th>Organismo</th>
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
                                $senha = $res[$i]['senha'];
                                $organismo = $res[$i]['organismo'];
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
                                    <td><?php echo $organismo ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="#" onclick="editar(
                                                    '<?php echo $id ?>', 
                                                    '<?php echo $nome ?>', 
                                                    '<?php echo $senha ?>', 
                                                    '<?php echo $email ?>', 
                                                    '<?php echo $cpf ?>', 
                                                    '<?php echo $foto ?>',                                            
                                                    )" title="Editar Senha"><i class="dw dw-edit2" data-color="#265ed7"></i></a>
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
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div class="row">
                                <div class="col-md-7 col-sm-12">
                                    <label>Nome: </label>
                                    <div class="input-group custom">
                                        <input type="text" id="nome" name="nome" class="form-control form-control-lg" placeholder="Nome e Sobrenome" disabled />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <label>CPF</label>
                                    <div class="input-group custom">
                                        <input type="text" id="cpf" name="cpf" class="form-control form-control-lg" placeholder="Informe o CPF" disabled />
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
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="name@exemple.com.br" disabled />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy bi bi-envelope"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5 col-sm-12">
                                    <label>Senha:</label>
                                    <div class="input-group custom">
                                        <input type="text" id="senha" name="senha" class="form-control form-control-lg" placeholder="Senha" required />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy bi bi-telephone-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
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

<script type="text/javascript">
    var pag = "<?= $pagina ?>"
</script>
<script src="../src/scripts/ajax.js"></script>

<script type="text/javascript">
    function editar(id, nome, senha, email, cpf, foto,) {
        $('#id').val(id);
        $('#nome').val(nome);
        $('#senha').val(senha);
        $('#email').val(email);
        $('#cpf').val(cpf);
        $('#target').attr('src', '../src/images/membros/' + foto);


        $('#tituloModal').text('Editar Senha');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }
</script>