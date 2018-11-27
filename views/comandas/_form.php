<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use app\models\Mesas;
use app\models\TbClientes;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\TbComandas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-comandas-form">    
    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" name="id_usuario" value="<?php echo Yii::$app->user->identity->id  ?>">
    <div class="row">
        <div class="col-md-4">
            <label>Cedula Cliente</label>
                <?php
                    $cedula = ArrayHelper::getColumn($clientes, function ($element) {
                        return $element['cedula'].": ".$element['nombres'].", ".$element['apellidos'];                        
                    });
                    echo AutoComplete::widget([
                        'options' => ['class'=> 'form-control cedula',
                                        'title' => 'Intoduzca el Número de Cédula del Cliente'
                                    ],
                        'id'=>'cedula_cliente',
                        'name' => 'cedula_cliente',
                        'clientOptions' => [
                            'source' => $cedula,
                        ],
                    ]);
                ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
                <?= $form->field($model, 'id_mesa')->dropDownList(ArrayHelper::map(Mesas::find()->all(),'id', 'id'),['prompt'=>'Mesa #',
                             'title' => 'Número de mesa',
                            ]
                ) ?>
                <label> Hora</label>
                <input type="text" name="h_pedido" id="h_pedido" value="" class="form-control" />
                <?php
                    $this->registerJs('
                        setInterval(function() {
                                    
                                        momentoActual = new Date(); 
                                        hora = parseInt(momentoActual.getHours()); 
                                        minuto = momentoActual.getMinutes(); 
                                        segundo = momentoActual.getSeconds(); 
                                            horaImprimible = hora + ":" + minuto + ":" + segundo;
                                            $("#h_pedido").val(horaImprimible);
                                }, 1000);');// cierra setInterval
                ?>    
        </div>
    </div>
        <div class="row">
            <!-- Expressos-->
            <div class="col-md-4 bg-cafe">
                <h2 class="hot">Café</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($cafe as $key => $expresso) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($expresso->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($expresso->id) ?>" id="ctd<?php echo($expresso->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($expresso->id) ?>" id="area<?php echo($expresso->id) ?>" value="<?php echo($expresso->area) ?>" ></td>
                            
                        <?php 
                            $this->registerJs('
                                var va'.$expresso->id.' = $("#ctd'.$expresso->id.'").val();
                                var x'.$expresso->id.' =  0;
                                var i'.$expresso->id.' = 0;
                                
                                $("#ctd'.$expresso->id.'").change(function(){
                                    var x'.$expresso->id.' =  1;
                                    return (x'.$expresso->id.');
                                });

                                $("#inc'.$expresso->id.'"  ).click(function(){ 
                                    i'.$expresso->id.'++;
                                    if(i'.$expresso->id.' >= 0){
                                        $("#ctd'.$expresso->id.'").val(i'.$expresso->id.');
                                    }
                                    if(x'.$expresso->id.' =  1){
                                        $("#ctd'.$expresso->id.'").val(va'.$expresso->id.' +  i'.$expresso->id.');
                                    }
    
                                });

                                $("#dec'.$expresso->id.'"  ).click(function(){ 
                                    i'.$expresso->id.'--;
                                    if(i'.$expresso->id.' >= 0){
                                        $("#ctd'.$expresso->id.'").val(i'.$expresso->id.');
                                    }
                                    
                                });
                            ');
                           } //end foreach expressos
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!--end expressos-->
            <!-- Lattes-->
            <div class="col-md-4 bg-lattes">
                <h2 class="latte">Lattes</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($lattes as $key => $latte) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($latte->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($latte->id) ?>" id="ctd<?php echo($latte->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($latte->id) ?>" id="area<?php echo($latte->id) ?>" value="<?php echo($latte->area) ?>"></td>
                            
                        <?php 
                            $this->registerJs('
                                var i'.$latte->id.' = 0;
                                $("#inc'.$latte->id.'"  ).click(function(){ 
                                    i'.$latte->id.'++;
                                    if(i'.$latte->id.' >= 0){
                                        $("#ctd'.$latte->id.'").val(i'.$latte->id.');
                                    }
                                });
                                $("#dec'.$latte->id.'"  ).click(function(){ 
                                    i'.$latte->id.'--;
                                    if(i'.$latte->id.' >= 0){
                                        $("#ctd'.$latte->id.'").val(i'.$latte->id.');
                                    }
                                });
                            ');
                           } //end foreach lattes
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!--end lattes -->
            <!-- bebidas frias -->
            <div class="col-md-4 bg-frias">
                <h2 class="b_frias">Bebidas Frías</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($b_frias as $key => $b_fria) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($b_fria->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($b_fria->id) ?>" id="ctd<?php echo($b_fria->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($b_fria->id) ?>" id="area<?php echo($b_fria->id) ?>" value="<?php echo($b_fria->area) ?>"></td>
                            
                        <?php 
                            $this->registerJs('
                                var i'.$b_fria->id.' = 0;
                                $("#inc'.$b_fria->id.'"  ).click(function(){ 
                                    i'.$b_fria->id.'++;
                                    if(i'.$b_fria->id.' >= 0){
                                        $("#ctd'.$b_fria->id.'").val(i'.$b_fria->id.');
                                    }
                                });
                                $("#dec'.$b_fria->id.'"  ).click(function(){ 
                                    i'.$b_fria->id.'--;
                                    if(i'.$b_fria->id.' >= 0){
                                        $("#ctd'.$b_fria->id.'").val(i'.$b_fria->id.');
                                    }
                                });
                            ');
                           } //end foreach b_frias
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!-- end bebidas frias -->
        </div>
        <div class="row">
            <!-- Energizantes -->
            <div class="col-md-4 bg-energy">
                <h2 class="energies">Energizantes</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($energys as $key => $energy) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($energy->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($energy->id) ?>" id="ctd<?php echo($energy->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($energy->id) ?>" id="area<?php echo($energy->id) ?>" value="<?php echo($energy->area) ?>"></td>
                            
                        <?php 
                            $this->registerJs('
                                var i'.$energy->id.' = 0;
                                $("#inc'.$energy->id.'"  ).click(function(){ 
                                    i'.$energy->id.'++;
                                    if(i'.$energy->id.' >= 0){
                                        $("#ctd'.$energy->id.'").val(i'.$energy->id.');
                                    }
                                });
                                $("#dec'.$energy->id.'"  ).click(function(){ 
                                    i'.$energy->id.'--;
                                    if(i'.$energy->id.' >= 0){
                                        $("#ctd'.$energy->id.'").val(i'.$energy->id.');
                                    }
                                });
                            ');
                           } //end foreach energy
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!-- End Energizantes -->
            <!-- Merengadas -->
            <div class="col-md-4 bg-shake">
                <h2 class="shakes">Merengadas</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($shakes as $key => $shake) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($shake->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($shake->id) ?>" id="ctd<?php echo($shake->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($shake->id) ?>" id="area<?php echo($shake->id) ?>" value="<?php echo($shake->area) ?>"></td>
                            
                        <?php 
                            $this->registerJs('
                                var i'.$shake->id.' = 0;
                                $("#inc'.$shake->id.'"  ).click(function(){ 
                                    i'.$shake->id.'++;
                                    if(i'.$shake->id.' >= 0){
                                        $("#ctd'.$shake->id.'").val(i'.$shake->id.');
                                    }
                                });
                                $("#dec'.$shake->id.'"  ).click(function(){ 
                                    i'.$shake->id.'--;
                                    if(i'.$shake->id.' >= 0){
                                        $("#ctd'.$shake->id.'").val(i'.$shake->id.');
                                    }
                                });
                            ');
                           } //end foreach shakes
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!-- end Merengadas-->
            <!-- Merengadas con frutas -->
            <div class="col-md-4 bg-shake-fruit">
                <h2 class="shakes-fruits">Merengadas con Frutas</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($fruits as $key => $fruit) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($fruit->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($fruit->id) ?>" id="ctd<?php echo($fruit->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($fruit->id) ?>" id="area<?php echo($fruit->id) ?>" value="<?php echo($fruit->area) ?>"></td>
                            
                        <?php 
                            $this->registerJs('
                                var i'.$fruit->id.' = 0;
                                $("#inc'.$fruit->id.'"  ).click(function(){ 
                                    i'.$fruit->id.'++;
                                    if(i'.$fruit->id.' >= 0){
                                        $("#ctd'.$fruit->id.'").val(i'.$fruit->id.');
                                    }
                                });
                                $("#dec'.$fruit->id.'"  ).click(function(){ 
                                    i'.$fruit->id.'--;
                                    if(i'.$fruit->id.' >= 0){
                                        $("#ctd'.$fruit->id.'").val(i'.$fruit->id.');
                                    }
                                });
                            ');
                           } //end foreach fruits
                        ?>
                    </tr>
                    <tr>
                       <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!-- End Merengadas con frutas -->
        </div><!-- div class row -->
        <div class="row">
            <!-- Paninis -->
            <div class="col-md-4 bg-paninis">
                <h2 class="paninis">Paninis</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($paninis as $key => $panini) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($panini->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($panini->id) ?>" id="ctd<?php echo($panini->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($panini->id) ?>" id="area<?php echo($panini->id) ?>" value="<?php echo($panini->area) ?>"></td>
                            
                        <?php 
                            $this->registerJs('
                                var i'.$panini->id.' = 0;
                                $("#inc'.$panini->id.'"  ).click(function(){ 
                                    i'.$panini->id.'++;
                                    if(i'.$panini->id.' >= 0){
                                        $("#ctd'.$panini->id.'").val(i'.$panini->id.');
                                    }
                                });
                                $("#dec'.$panini->id.'"  ).click(function(){ 
                                    i'.$panini->id.'--;
                                    if(i'.$panini->id.' >= 0){
                                        $("#ctd'.$panini->id.'").val(i'.$panini->id.');
                                    }
                                });
                            ');
                           } //end foreach paninis
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!-- End Paninis -->
            <!-- Ensaladas -->
            <div class="col-md-4 bg-salads">
                <h2 class="salads">Ensaladas</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($ensaladas as $key => $ensalada) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($ensalada->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($ensalada->id) ?>" id="ctd<?php echo($ensalada->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($ensalada->id) ?>" id="area<?php echo($ensalada->id) ?>" value="<?php echo($ensalada->area) ?>"></td>
                            
                        <?php 
                            $this->registerJs('
                                var i'.$ensalada->id.' = 0;
                                $("#inc'.$ensalada->id.'"  ).click(function(){ 
                                    i'.$ensalada->id.'++;
                                    if(i'.$ensalada->id.' >= 0){
                                        $("#ctd'.$ensalada->id.'").val(i'.$ensalada->id.');
                                    }
                                });
                                $("#dec'.$ensalada->id.'"  ).click(function(){ 
                                    i'.$ensalada->id.'--;
                                    if(i'.$ensalada->id.' >= 0){
                                        $("#ctd'.$ensalada->id.'").val(i'.$ensalada->id.');
                                    }
                                });
                            ');
                           } //end foreach salads
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!-- End Ensaladas -->
            <!-- Hot Cakes -->
            <div class="col-md-4 bg-hot-cakes">
                <h2 class="hot-cakes">Hot Cakes</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($hotcakes as $key => $hotcake) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($hotcake->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($hotcake->id) ?>" id="ctd<?php echo($hotcake->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($hotcake->id) ?>" id="area<?php echo($hotcake->id) ?>" value="<?php echo($hotcake->area) ?>"></td>
                            
                        <?php 
                            $this->registerJs('
                                var i'.$hotcake->id.' = 0;
                                $("#inc'.$hotcake->id.'"  ).click(function(){ 
                                    i'.$hotcake->id.'++;
                                    if(i'.$hotcake->id.' >= 0){
                                        $("#ctd'.$hotcake->id.'").val(i'.$hotcake->id.');
                                    }
                                });
                                $("#dec'.$hotcake->id.'"  ).click(function(){ 
                                    i'.$hotcake->id.'--;
                                    if(i'.$hotcake->id.' >= 0){
                                        $("#ctd'.$hotcake->id.'").val(i'.$hotcake->id.');
                                    }
                                });
                            ');
                           } //end foreach hotcakes
                        ?>
                    </tr>
                    <tr>
                       <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!-- End Hot Cakes -->  
        </div>
        <div class="row">
            <!--Reposteria -->
            <div class="col-md-4 bg-respoteria">
                <h2 class="respoteria">Reposteria</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($tortas as $key => $torta) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($torta->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($torta->id) ?>" id="ctd<?php echo($torta->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($torta->id) ?>" id="area<?php echo($torta->id) ?>" value="<?php echo($torta->area) ?>"></td>
                            
                        <?php 
                            $this->registerJs('
                                var i'.$torta->id.' = 0;
                                $("#inc'.$torta->id.'"  ).click(function(){ 
                                    i'.$torta->id.'++;
                                    if(i'.$torta->id.' >= 0){
                                        $("#ctd'.$torta->id.'").val(i'.$torta->id.');
                                    }
                                });
                                $("#dec'.$torta->id.'"  ).click(function(){ 
                                    i'.$torta->id.'--;
                                    if(i'.$torta->id.' >= 0){
                                        $("#ctd'.$torta->id.'").val(i'.$torta->id.');
                                    }
                                });
                            ');
                           } //end foreach cakes
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!-- End Reposteria -->
            <!-- Postres -->
            <div class="col-md-4 bg-postres">
                <h2 class="postres">Postres</h2>
                <table class="table table-bordered table-comanda">
                    <tr>
                        <th>Producto</th>
                        <th>Pedido</th>
                    </tr>
                        <?php  
                            foreach ($postres as $key => $postre) {
                        ?>
                    <tr>
                            <td><!-- Producto -->
                                <?php  echo($postre->producto) ?>
                            </td>
                            <!-- Botones e Input-->
                            
                            <td class="input-value"><input type="number"  min="0" name="ctd<?php echo($postre->id) ?>" id="ctd<?php echo($postre->id) ?>" placeholder="0" class="form-control rigth">
                                <input type="hidden" name="area<?php echo($postre->id) ?>" id="area<?php echo($postre->id) ?>" value="<?php echo($postre->area) ?>"></td>
                            
                        <?php 
                            $this->registerJs('
                                var i'.$postre->id.' = 0;
                                $("#inc'.$postre->id.'"  ).click(function(){ 
                                    i'.$postre->id.'++;
                                    if(i'.$postre->id.' >= 0){
                                        $("#ctd'.$postre->id.'").val(i'.$postre->id.');
                                    }
                                });
                                $("#dec'.$postre->id.'"  ).click(function(){ 
                                    i'.$postre->id.'--;
                                    if(i'.$postre->id.' >= 0){
                                        $("#ctd'.$postre->id.'").val(i'.$postre->id.');
                                    }
                                });
                            ');
                           } //end foreach deserts
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2" class="tooltip_">
                            <span class="tooltiptext">Incluya las Observaciones</span>
                            <input type="text" placeholder="Observaciones" name="obs_expressos"  id="obs_expressos" class="form-control">
                        </td>
                    </tr>
                </table>     
            </div><!-- div class col-md-4 -->
            <!-- End Postres -->
        </div><!-- row -->

    <div class="form-group button-send">
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn_custom']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

