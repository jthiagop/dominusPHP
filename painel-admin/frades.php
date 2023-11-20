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
                                $endereco = $res[$i]['endereco'];
                                $telefone = $res[$i]['telefone'];
                                $foto = $res[$i]['foto'];
                                $data_nasc = $res[$i]['data_nasc'];
                                $data_cad = $res[$i]['data_cad'];
                                $obs = $res[$i]['obs'];
                                $organismo = $res[$i]['organismo'];
                                $id = $res[$i]['id'];

                                $query_org = $pdo->query("SELECT * FROM organismos where id = '$organismo' ");
                                $res_org = $query_org->fetchAll(PDO::FETCH_ASSOC);
                                if(count($res_org) > 0 ){
                                    $nome_org = $res_org[0]['razaosocial'];
                                } else {
                                    $nome_org = $nome_organismo;
                                }


                                //retirar quebra de texto do obs
                                $obs = str_replace(array("\n", "\r"), ' + ', $obs);

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
                                    <td><?php echo $nome_org ?></td>
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
                                                    '<?php echo $organismo ?>',                                            
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
                                                    '<?php echo $nome_org ?>',
                                                    )" title="Ver Registro"><i class="icon-copy bi bi-info-circle text-info"></i> </a>
                                            <a href="#" onclick="obs(
                                                    '<?php echo $id ?>',
                                                    '<?php echo $nome ?>',
                                                    '<?php echo $obs ?>'
                                                    )" title="Observações"><i class="icon-copy bi bi-chat-text"></i> </a>
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

<!-- add task popup start -->
<div class="modal fade customscroll" id="modalObs" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Observações - <span id="nome-obs"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-obs" method="post">
                <div class="modal-body pd-0">
                    <small>
                        <div id="mensagem-obs"></div>
                    </small>
                    <div class="task-list-form">
                        <ul>
                            <li>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="exampleFormControlInput1">Observações </label>
                                        <textarea id="obs" name="obs" maxlength="500" class="form-control"></textarea>
                                        <small>
                                            <p class="text-right">(Maxímo 500 Caracteres)</p>
                                        </small>
                                    </div>
                                </div>

                                <input type="hidden" id="id-obs" name="id-obs">

                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Sair
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add task popup End -->

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
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-blue" data-toggle="tab" href="#home" role="tab" aria-selected="true">Dados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Organismos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#contact" role="tab" aria-selected="false">Contact</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home" role="tabpanel">
                                <div class="pd-20">
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
                                                        <input type="date" id="data_nasc" name="data_nasc" value="<?php echo date('Y-m-d') ?>" class="form-control form-control-lg" required />
                                                    </div>
                                                </div>
                                                <input type="hidden" id="id" name="id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel">
                                <div class="pd-20">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Selecionar Organismo</label>
                                                <select class="custom-select2 form-control" id="organismo" name="organismo" style="width: 100%; height: 38px">
                                                    <?php
                                                    $query = $pdo->query("SELECT * FROM organismos order by razaosocial asc");
                                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                                    $total_reg = count($res);
                                                    if ($total_reg > 0) {

                                                        for ($i = 0; $i < @count($res); $i++) {
                                                            foreach ($res[$i] as $key => $value) {
                                                            }

                                                            $razaosocial_org = $res[$i]['razaosocial'];
                                                            $id_org = $res[$i]['id'];
                                                    ?>
                                                            <option value="<?php echo $id_org ?>"><?php echo $razaosocial_org ?></option>

                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel">
                                <div class="pd-20">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis
                                    nostrud exercitation ullamco laboris nisi ut aliquip ex
                                    ea commodo consequat. Duis aute irure dolor in
                                    reprehenderit in voluptate velit esse cillum dolore eu
                                    fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident, sunt in culpa qui officia deserunt mollit
                                    anim id est laborum.
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
                        <div class="row">
                            <li class="col-md-12 col-sm-12">
                                <span>Organismo :</span>
                                <p class="text-muted mb-0" id="organismo_dados"></p>
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
    function editar(id, nome, email, cpf, telefone, endereco, foto, data_nasc, organismo) {
        $('#id').val(id);
        $('#nome').val(nome);
        $('#email').val(email);
        $('#cpf').val(cpf);
        $('#telefone').val(telefone);
        $('#endereco').val(endereco);
        $('#data_nasc').val(data_nasc);

        $('#organismo').val(organismo).change();

        $('#target').attr('src', '../src/images/membros/' + foto);


        $('#tituloModal').text('Editar Registro');
        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
        myModal.show();
        $('#mensagem').text('');
    }

    function dados(nome, email, cpf, telefone, endereco, foto, data_nasc, data_cad, organismo) {
        $('#nome-dados').text(nome);
        $('#email-dados').text(email);
        $('#cpf-dados').text(cpf);
        $('#telefone-dados').text(telefone);
        $('#endereco-dados').text(endereco);
        $('#data_cad').text(data_cad);
        $('#organismo_dados').text(organismo);
        $('#foto-dados').attr('src', '../src/images/membros/' + foto);

        var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {});
        myModal.show();
        $('#mensagem').text('');
    }

    function obs(id, nome, obs) {

        for (let letra of obs) {
            if (letra === '+') {
                obs = obs.replace(' +  + ', '\n')
            }
        }

        $('#id-obs').val(id);
        $('#nome-obs').text(nome);
        $('#obs').val(obs);

        var myModal = new bootstrap.Modal(document.getElementById('modalObs'), {});
        myModal.show();
        $('#mensagem-obs').text('');
    }
</script>

<script type="text/javascript">
    // Format options
    const optionFormat = (item) => {
        if (!item.id) {
            return item.text;
        }

        var span = document.createElement('span');
        var template = '';

        template += '<div class="d-flex align-items-center">';
        template += '<img src="' + item.element.getAttribute('data-kt-rich-content-icon') + '" class="rounded-circle h-40px me-3" alt="' + item.text + '"/>';
        template += '<div class="d-flex flex-column">'
        template += '<span class="fs-4 fw-bold lh-1">' + item.text + '</span>';
        template += '<span class="text-muted fs-5">' + item.element.getAttribute('data-kt-rich-content-subcontent') + '</span>';
        template += '</div>';
        template += '</div>';

        span.innerHTML = template;

        return $(span);
    }

    // Init Select2 --- more info: https://select2.org/
    $('#kt_docs_select2_rich_content').select2({
        placeholder: "Select an option",
        minimumResultsForSearch: Infinity,
        templateSelection: optionFormat,
        templateResult: optionFormat
    });
</script>