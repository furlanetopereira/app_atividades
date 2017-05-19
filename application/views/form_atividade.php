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
    <link href="<?=base_url();?>static/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

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
            <li><a href="<?=base_url();?>atividades">Listar Atividades</a></li>
            <li class="active"><a href="<?=base_url();?>atividade/nova">Nova Atividade</a></li>
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

      <?php
        if($atividade['id_status']=='4'){
          $disabled = 'disabled';
        }else{
          $disabled='';
        }
      ?>

      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">Formulário</div>
            <div class="panel-body">  
              <form id="form" class="form-horizontal" method="post" action="">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nome: *</label>
                  <div class="col-sm-10">
                    <input type="text" name="nome" <?=$disabled;?> class="form-control" value="<?=$atividade['nome']
                    ;?>" maxlength="255"  />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Descrição: *</label>
                  <div class="col-sm-10">
                    <textarea name="descricao" <?=$disabled;?> class="form-control" maxlength="600"><?=$atividade['descricao']
                    ;?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Data de Inicio: *</label>
                  <div class="col-sm-4">
                    <input type="text" name="data_inicio" <?=$disabled;?> value="<?=Bd2data($atividade['data_inicio']);?>" class="mask datepicker form-control" data-inputmask="'mask': '99/99/9999'"  />
                  </div>
                  <label class="col-sm-2 control-label">Data de Fim:</label>
                  <div class="col-sm-4">
                    <input type="text" name="data_fim" <?=$disabled;?> id="data_fim" value="<?=Bd2data($atividade['data_fim']);?>" class="mask datepicker form-control" data-inputmask="'mask': '99/99/9999'"  />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Status: *</label>
                  <div class="col-sm-4">
                    <select name="id_status" <?=$disabled;?> onChange="Status(this);" class="form-control">
                      <optgroup label="Selecione o Status">
                        <?php
                          foreach($status as $item):
                        ?>
                          <option value="<?=$item['id'];?>" 
                            <?php 
                            if($atividade['id_status']==$item['id']){ echo 'selected'; }; 
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
                  <label class="col-sm-2 control-label">Situação: *</label>
                  <div class="col-sm-4">
                    <select name="id_situacao" <?=$disabled;?> class="form-control">
                      <optgroup label="Selecione a Situação">
                        <option value="1" 
                            <?php 
                            if($atividade['id_situacao']=='1'){ echo 'selected'; }; 
                            ?>
                          >Ativo</option>
                        <option value="0" 
                            <?php 
                            if($atividade['id_situacao']=='0'){ echo 'selected'; }; 
                            ?>
                          >Inativo</option>
                      </optgroup>
                    </select>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-2 col-sm-8">
                      <a href="<?=base_url();?>" class="btn btn-default">Voltar</a> &nbsp; &nbsp;
                      <?php
                        if($atividade['id_status']!='4'):
                      ?>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                      <?php
                        endif;
                      ?>
                    </div>
                  </div>
                </div>
              </form> 
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

    <script src="<?=base_url();?>static/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>static/assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>

    <script src="<?=base_url();?>static/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>static/assets/plugins/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=base_url();?>bootstrap-3.3.7/docs/assets/js/ie10-viewport-bug-workaround.js"></script>


    <script>
      $( function() {
        $( ".datepicker" ).datepicker({
            format: 'dd/mm/yyyy',                
            language: 'pt-BR'
        });
      } );
      $(function() { $('.mask').inputmask(); });

      $("#form").validate({
        rules : {
          nome:{
            required:true,
            minlength:3
          },
          descricao:{
            required:true
          },
          data_inicio:{
            required:true
          } ,
          id_status:{
            required:true
          } ,
          id_situacao:{
            required:true
          }                                
        },
        messages:{
          nome:{
            required:"Campo obrigatório",
            minlength:"O campo deve ter pelo menos 3 caracteres"
          },
          descricao:{
            required:"Campo obrigatório",
            minlength:"O campo deve ter pelo menos 3 caracteres"
          },
          data_inicio:{
            required:"Campo obrigatório"
          }, 
          id_status:{
            required:"Campo obrigatório"
          }, 
          id_situacao:{
            required:"Campo obrigatório"
          },   
        }
      });

      function Status(obj){
        if(obj.value=='4'){
          $( "#data_fim" ).rules( "add", {
            required: true,
            messages: {
              required:"Campo obrigatório"
            }
          });
        }else{
          $( "#data_fim" ).rules( "remove" );
        }
      }
    </script>
  </body>
</html>
