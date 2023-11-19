<?php
require_once('../conexao.php');
require_once('verificar.php');
$pagina = 'organismos';
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
                            Organismos
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a class="btn btn-primary icon-copy bi bi-person-plus-fill" href="#" type="button" onclick="inserir()" data-toggle="modal" data-target="#modalForm">
                        Novo Organismo
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $query = $pdo->query("SELECT * FROM $pagina order by id asc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = count($res);
    if ($total_reg > 0) {
    ?>
        <div class="min-height-200px">
            <!-- Simple Datatable Simples -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Registro de Organismos</h4>
                </div>
                <div class="pb-20">
                    <table id="administradores" class="data-table table stripe hover nowrap">
                        <thead>

                            <tr>
                                <th>ID</th>
                                <th class="table-plus datatable-nosort">Razão Social</th>
                                <th>CNPJ </th>
                                <th>Cidade </th>
                                <th>Bairro</th>
                                <th>UF</th>
                                <th>Ações</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < @count($res); $i++) {
                                foreach ($res[$i] as $key => $value) {
                                }
                                $razaosocial = $res[$i]['razaosocial'];
                                $cnpj = $res[$i]['cnpj'];
                                $data_cnpj = $res[$i]['data_cnpj'];
                                $data_fundacao = $res[$i]['data_fundacao'];
                                $cep = $res[$i]['cep'];
                                $rua = $res[$i]['rua'];
                                $bairro = $res[$i]['bairro'];
                                $cidade = $res[$i]['cidade'];
                                $uf = $res[$i]['uf'];
                                $email = $res[$i]['email'];
                                $cep = $res[$i]['cep'];
                                $telefone = $res[$i]['telefone'];
                                $foto = $res[$i]['foto'];
                                $data_cad = $res[$i]['data_cad'];
                                $obs = $res[$i]['obs'];
                                $matriz = $res[$i]['matriz'];
                                $id = $res[$i]['id'];

                                //retirar quebra de texto do obs
                                $obs = str_replace(array("\n", "\r"), ' + ', $obs);

                                $data_cnpjF = implode('/', array_reverse(explode('-', $data_cnpj)));
                                $data_fundacaoF = implode('/', array_reverse(explode('-', $data_fundacao)));

                            ?>
                                <tr>
                                    <td><?php echo $id ?></td>
                                    <td>
                                        <div class="name-avatar d-flex align-items-center">
                                            <div class="avatar mr-2 flex-shrink-0">
                                                <img src="../src/images/organismos/<?php echo $foto ?>" class="border-radius-100 shadow border border-primary" width="40" height="40" alt="" />
                                            </div>
                                            <div class="txt">
                                                <div class="weight-600"><?php echo $razaosocial ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $cnpj ?></td>
                                    <td><?php echo $cidade ?></td>
                                    <td><?php echo $bairro ?></td>

                                    <td><?php echo $uf ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="#" onclick="editar(
                                                    '<?php echo $id ?>', 
                                                    '<?php echo $razaosocial ?>', 
                                                    '<?php echo $cnpj ?>', 
                                                    '<?php echo $data_cnpj ?>',
                                                    '<?php echo $data_fundacao ?>',
                                                    '<?php echo $cep ?>', 
                                                    '<?php echo $rua ?>', 
                                                    '<?php echo $bairro ?>', 
                                                    '<?php echo $cidade ?>', 
                                                    '<?php echo $uf ?>', 
                                                    '<?php echo $email ?>', 
                                                    '<?php echo $telefone ?>', 
                                                    '<?php echo $foto ?>',
                                                    '<?php echo $data_cad ?>', 
                                                    '<?php echo $matriz ?>',
                                                    )" title="Editar Registro"><i class="dw dw-edit2" data-color="#265ed7"></i></a>
                                            <a href="#" onclick="excluir('<?php echo $id ?>', '<?php echo $razaosocial ?>')" title="Excluir Registro"><i class="dw dw-delete-3" data-color="#e95959"></i> </a>
                                            <a href="#" onclick="dados(
                                                    '<?php echo $razaosocial ?>',
                                                    '<?php echo $email ?>', 
                                                    '<?php echo $cnpj ?>', 
                                                    '<?php echo $telefone ?>', 
                                                    '<?php echo $rua ?>',
                                                    '<?php echo $foto ?>',
                                                    )" title="Ver Registro"><i class="icon-copy bi bi-info-circle text-info"></i> </a>
                                            <a href="#" onclick="obs(
                                                    '<?php echo $id ?>',
                                                    '<?php echo $raz ?>',
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
                    <div class="row">
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#home" role="tab" aria-selected="true">Geral</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Endereço</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#contact" role="tab" aria-selected="false">Observações</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class=" pd-20">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                                <div class="profile-photo" id="divImg">
                                                    <img src="../src/images/organismos/<?php echo $foto ?>" id="target" alt="Foto de Perfil" class=" my-2 profile-photo avatar-photo img-thumbnail" />
                                                    <input type="file" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>Razão Social: </label>
                                                        <div class="input-group custom">
                                                            <input type="text" id="razaosocial" name="razaosocial" class="form-control form-control-lg" placeholder="Informe a Razão Social" />
                                                            <div class="input-group-append custom">
                                                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5 col-sm-12">
                                                        <label>CNPJ:</label>
                                                        <div class="input-group custom">
                                                            <input type="text" id="cnpj" name="cnpj" class="form-control form-control-lg" placeholder="Informe o CPF" />
                                                            <div class="input-group-append custom">
                                                                <span class="input-group-text"><i class="icon-copy bi bi-card-text"></i></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 col-sm-12">
                                                        <label>E-mail</label>
                                                        <div class="input-group custom">
                                                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="name@exemple.com.br" />
                                                            <div class="input-group-append custom">
                                                                <span class="input-group-text"><i class="icon-copy bi bi-envelope"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label>Data de Fundação:</label>
                                                        <div class="input-group custom">
                                                            <input type="date" id="data_fundacao" name="data_fundacao" class="form-control form-control-lg" placeholder="Digite a data" />
                                                            <div class="input-group-append custom">
                                                                <span class="input-group-text"><i class="icon-copy fa fa-map-o" aria-hidden="true"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label>Emissão de CNPJ : </label>
                                                        <div class="input-group custom">
                                                            <input type="date" id="data_cnpj" name="data_cnpj" value="<?php echo date('Y-m-d') ?>" class="form-control form-control-lg" />
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
                                            <div class="col-md-12 col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-12">
                                                        <label>CEP : </label>
                                                        <div class="input-group custom">
                                                            <input type="text" id="cep" name="cep" class="form-control form-control-lg" placeholder="Infome o CEP" />
                                                            <div class="input-group-append custom">
                                                                <span class="input-group-text"><i class="icon-copy fa fa-map-o" aria-hidden="true"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label>Rua :</label>
                                                        <div class="input-group custom">
                                                            <input type="text" id="rua" name="rua" class="form-control form-control-lg" placeholder="Informe a " />
                                                            <div class="input-group-append custom">
                                                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label>Telefone :</label>
                                                        <div class="input-group custom">
                                                            <input type="text" id="telefone" name="telefone" class="form-control form-control-lg" placeholder="Informe a " />
                                                            <div class="input-group-append custom">
                                                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-12">
                                                        <label>Bairro :</label>
                                                        <div class="input-group custom">
                                                            <input type="text" id="bairro" name="bairro" class="form-control form-control-lg" placeholder="Informe o bairro" />
                                                            <div class="input-group-append custom">
                                                                <span class="input-group-text"><i class="icon-copy bi bi-card-text"></i></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-sm-12">
                                                        <label>Cidade</label>
                                                        <div class="input-group custom">
                                                            <input type="text" id="cidade" name="cidade" class="form-control form-control-lg" placeholder="Informe a cidade" />
                                                            <div class="input-group-append custom">
                                                                <span class="input-group-text"><i class="icon-copy bi bi-building"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label>UF</label>
                                                        <div class="input-group custom">
                                                            
                                                            <select id="uf" name="uf" class="custom-select col-12">
                                                                <option value="">Selecione</option>
                                                                <option value="AC">Acre</option>
                                                                <option value="AL">Alagoas</option>
                                                                <option value="AP">Amapá</option>
                                                                <option value="AM">Amazonas</option>
                                                                <option value="BA">Bahia</option>
                                                                <option value="CE">Ceará</option>
                                                                <option value="DF">Distrito Federal</option>
                                                                <option value="ES">Espirito Santo</option>
                                                                <option value="GO">Goiás</option>
                                                                <option value="MA">Maranhão</option>
                                                                <option value="MS">Mato Grosso do Sul</option>
                                                                <option value="MT">Mato Grosso</option>
                                                                <option value="MG">Minas Gerais</option>
                                                                <option value="PA">Pará</option>
                                                                <option value="PB">Paraíba</option>
                                                                <option value="PR">Paraná</option>
                                                                <option value="PE">Pernambuco</option>
                                                                <option value="PI">Piauí</option>
                                                                <option value="RJ">Rio de Janeiro</option>
                                                                <option value="RN">Rio Grande do Norte</option>
                                                                <option value="RS">Rio Grande do Sul</option>
                                                                <option value="RO">Rondônia</option>
                                                                <option value="RR">Roraima</option>
                                                                <option value="SC">Santa Catarina</option>
                                                                <option value="SP">São Paulo</option>
                                                                <option value="SE">Sergipe</option>
                                                                <option value="TO">Tocantins</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <p class="mb-30">Insira algumas infomações sobre o organismo:</p>
                                            </div>
                                            <div class="">
                                                <textarea class="form-control"></textarea>
                                            </div>
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
                    <img src="../src/images/organismos/<?php echo $foto ?>" id="foto-dados" alt="Foto de Perfil" class=" my-2 profile-photo avatar-photo img-thumbnail" width="500px" />
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
                                <span>Emissão do CNPJ:</span>
                                <p class="text-muted mb-0" id="data_nasc"><?php echo $data_cnpj ?></p>
                            </li>
                            <li class="col-md-6 col-sm-12">
                                <span>Data de fundação:</span>
                                <p class="text-muted mb-0" id="data_cad"><?php echo $data_fundacao ?></p>
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
    function editar(id, razaosocial, cnpj, data_cnpj, data_fundacao, cep, rua,
        bairro, cidade, uf, email, telefone, foto, data_cad, matriz) {
        $('#id').val(id);
        $('#razaosocial').val(razaosocial);
        $('#cnpj').val(cnpj);
        $('#data_cnpj').val(data_cnpj);
        $('#data_fundacao').val(data_fundacao);
        $('#cep').val(cep);
        $('#rua').val(rua);
        $('#bairro').val(bairro);
        $('#cidade').val(cidade);
        $('#uf').val(uf);
        $('#email').val(email);
        $('#telefone').val(telefone);
        $('#foto').val(foto);
        $('#data_cad').val(data_nasc);
        $('#matriz').val(matriz);

        $('#target').attr('src', '../src/images/organismos/' + foto);


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
        $('#foto-dados').attr('src', '../src/images/organismos/' + foto);

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