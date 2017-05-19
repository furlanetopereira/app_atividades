<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt_br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Paulo Afonso">
    <link rel="icon" href="<?=base_url();?>bootstrap-3.3.7/docs/favicon.ico">

    <title>App Atividades</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url();?>bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="<?=base_url();?>bootstrap-3.3.7/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?=base_url();?>bootstrap-3.3.7/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url();?>bootstrap-3.3.7/docs/examples/theme/theme.css" rel="stylesheet">
    <link href="<?=base_url();?>static/css/datatables.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?=base_url();?>bootstrap-3.3.7/docs/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url();?>">App Atividades</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?=base_url();?>atividades">Listar Atividades</a></li>
            <li><a href="<?=base_url();?>atividade/nova">Nova Atividade</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

      <div class="page-header">
        <h1>Atividades</h1>
      </div>

      <?php 
        if ($this->session->flashdata('error') == TRUE): 
      ?>
        <div class="alert alert-danger" role="alert">
          <strong><?php echo $this->session->flashdata('error'); ?></strong>
        </div>
      <?php 
        endif; 

        if ($this->session->flashdata('success') == TRUE): 
      ?>
        <div class="alert alert-success" role="alert">
          <strong><?php echo $this->session->flashdata('success'); ?></strong>
        </div>
      <?php 
        endif; 
      ?>

      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">Pesquisar</div>
            <div class="panel-body">              
              <form id="form" class="form-horizontal" method="post" action="">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Status:</label>
                  <div class="col-sm-4">
                    <select name="id_status" <?=$disabled;?> onChange="Status(this);" class="form-control">
                      <optgroup label="Selecione o Status">
                        <option value="">Todos</option>
                        <?php
                          foreach($status as $item):
                        ?>
                          <option value="<?=$item['id'];?>" 
                            <?php 
                            if(set_value('id_status')==$item['id']){ echo 'selected'; }; 
                            ?>
                          >
                            <?=$item['status'];?>                        
                          </option>
                        <?php
                          endforeach;
                        ?>                     
                      </optgroup>
                    </select>
                  </div>
                  <label class="col-sm-2 control-label">Situação:</label>
                  <div class="col-sm-4">
                    <select name="id_situacao" <?=$disabled;?> class="form-control">
                      <optgroup label="Selecione a Situação">
                        <option value="">Todos</option>
                        <option value="1" 
                            <?php 
                            if(set_value('id_situacao')=='1'){ echo 'selected'; }; 
                            ?>
                          >Ativo</option>
                        <option value="0" 
                            <?php 
                            if(set_value('id_situacao')=='0'){ echo 'selected'; }; 
                            ?>
                          >Inativo</option>
                      </optgroup>
                    </select>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-2 col-sm-8">
                      <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </div>
                  </div>
                </div>
              </form> 
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading">Listagem</div>
            <div class="panel-body"> 
              <table class="table" id="listagem">
                <thead>
                  <tr>
                    <th width="10%">id</th>
                    <th width="40%">Nome</th>
                    <th width="20%">Status</th>
                    <th width="20%">Situação</th>
                    <th width="10%">Ação</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($atividades as $atividade):
                      if($atividade['id_status']=='4'){
                        $cor='#dff0d8';
                      }else{
                        $cor='';
                      }

                  ?>
                  <tr style='background-color:<?=$cor;?>;'>
                    <td><?=$atividade['id'];?></td>
                    <td><?=$atividade['nome'];?></td>
                    <td><?=$status[array_search($atividade['id_status'], array_column($status, 'id'))]['status'];?></td>
                    <td>
                      <?php
                        if($atividade['id_situacao']=='1') echo 'Ativo';
                        if($atividade['id_situacao']=='0') echo 'Inativo';
                      ?>    
                    </td>
                    <td>
                      <a href="<?=base_url();?>atividade/editar/<?=$atividade['id'];?>" class="btn btn-sm btn-default">Editar</a>
                    </td>
                  </tr>
                  <?php
                    endforeach;
                  ?>
                </tbody>
              </table>
              <p align="center">
                <a href="<?=base_url();?>atividade/nova" class="btn btn-info">Nova Atividade</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?=base_url();?>bootstrap-3.3.7/docs/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?=base_url();?>bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>bootstrap-3.3.7/docs/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=base_url();?>bootstrap-3.3.7/docs/assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src="<?=base_url();?>static/js/datatables.min.js"></script>
    <script src="<?=base_url();?>static/js/datatable_pt-br_lang.json"></script>

    <script>
    jQuery(document).ready(function(){
        jQuery("#listagem").DataTable({
            "info":false,
            "searching":false,
            "language": {
                "url" : '<?=base_url();?>static/js/datatable_pt-br_lang.json'
            }
        });
    });
    </script>
  </body>
</html>
