<?php

namespace app\controllers;

use Yii;
use app\models\Mesas;
use app\models\TbProductos;
use app\models\TbComandas;
use app\models\TbClientes;
use app\models\TbUsuarios;
use app\models\TbCafe;
use app\models\TbCocina;
use app\models\TbMesas;
use app\models\TbComandasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use yii\bootstrap\Modal;
/**
 * ComandasController implements the CRUD actions for TbComandas model.
 */
class ComandasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TbComandas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = TbComandas::find()->orderBy(['id'=>SORT_DESC])->all();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => count($model),
        ]);

        $searchModel = new TbComandasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'pagination'=>$pagination,
        ]);
    }
    /*test*/
    /**
     * Lists all TbComandas models.
     * @return mixed
     */
    public function actionIndex_ajax()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $filename = $data['id'];
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = ['filename' => $filename];
            $response->statusCode = 200;
            return $response;
        }



        $model = TbComandas::find()->orderBy(['id'=>SORT_DESC])->all();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => count($model),
        ]);

        $searchModel = new TbComandasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index_ajax', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'pagination'=>$pagination,
        ]);
    }

    /*end test*/

    /**
     * Displays a single TbComandas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $id_cliente, $id_productos, $id_usuario)
    {
        $usuario = TbUsuarios::find()->where(['id' => $_GET['id_usuario']])->one();
        $productos = explode(",", $id_productos); 

        foreach ($productos as $key => $value) {
            $descripcion[] = TbProductos::find()->where(['id' => $value])->all();
        }
        foreach ($descripcion as $key => $value_desc) {
            $lista[] = $value_desc[0]['producto'];
        }
        $pedido = implode("/ ", $lista);
    
        return $this->render('view', [
            'model' => $this->findModel($id),
            'usuario' => $usuario,
            'pedido' => $pedido,
        ]);
    }

    /**
     * Creates a new TbComandas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbComandas();

        if ($model->load(Yii::$app->request->post())) {
           $ced_post = (substr($_POST['cedula_cliente'],0,8));
           $cedula = explode(":", $ced_post);
           $consult = TbClientes::find()->where(['cedula' => $cedula[0]])->one();
           $count = count(TbProductos::find()->all());
               if (isset($consult)) {
                    for ($i=1; $i <= $count ; $i++) {
                         if($_POST['ctd'.$i.''] != 0){
                            $id = $i;
                            $producto = TbProductos::find()->where(['id' => $id])->all();
                            $id_productos[] = $producto[0]['id'];
                            $ctd[] = $_POST['ctd'.$i.''];
                         }
                   }

                    $elemento = implode(",",$id_productos);
                    $cantidad = implode(",",$ctd);
                        $cafe = new TbComandas();
                        $cafe->id_productos = $elemento;
                        $cafe->ctd = $cantidad;
                        $cafe->id_usuario = $_POST['id_usuario'];
                        $cafe->id_mesa = $_POST['TbComandas']['id_mesa'];
                        $cafe->id_cliente = $cedula[0];
                        $cafe->status = 0;
                        foreach ($id_productos as $key => $value_pedido) {
                            if ( (int)$value_pedido<= 17) {
                                $cafe->status_cafe = 1;
                            }
                            if ((int)$value_pedido >= 18) {
                                 $cafe->status_cocina = 1;
                            }
                        }
                        $cafe->obs_expressos = $_POST['obs_expressos'];
                        $cafe->obs_lattes = $_POST['obs_lattes'];
                        $cafe->obs_bfrias = $_POST['obs_bfrias'];
                        $cafe->obs_energy = $_POST['obs_energy'];
                        $cafe->obs_shake = $_POST['obs_shake'];
                        $cafe->obs_fruits = $_POST['obs_fruits'];
                        $cafe->obs_paninis = $_POST['obs_paninis'];
                        $cafe->obs_salads = $_POST['obs_salads'];
                        $cafe->obs_hotcakes = $_POST['obs_hotcakes'];
                        $cafe->obs_cakes = $_POST['obs_cakes'];
                        $cafe->obs_deserts = $_POST['obs_deserts'];
                        $cafe->h_pedido = $_POST['h_pedido'];
                            $cafe->save(false);

                        $areaMesas = new TbMesas();
                            $areaMesas->id_comanda =  $cafe->id;
                            $areaMesas->h_entrada  =  $_POST['h_pedido'];
                            $areaMesas->save(false);

                        $areaCafe = new TbCafe();
                            $areaCafe->id_comanda =  $cafe->id;
                            $areaCafe->h_entrada  =  $_POST['h_pedido'];
                            $areaCafe->save(false);

                        $areaCocina = new TbCocina();
                            $areaCocina->id_comanda =  $cafe->id;
                            $areaCocina->h_entrada  =  $_POST['h_pedido'];
                            $areaCocina->save(false);

                    Yii::$app->session->setFlash('error', "Nuevo pedido, Mesa: ".$_POST['TbComandas']['id_mesa']);
                    return $this->redirect(['index']);
               }else{
                    $ced_post = (substr($_POST['cedula_cliente'],0,8));
                    $cedula = explode(":", $ced_post);
                    $count = count(TbProductos::find()->all());
                        for ($i=1; $i <= $count ; $i++) {
                             if($_POST['ctd'.$i.''] != 0){
                                $id = $i;
                                $producto = TbProductos::find()->where(['id' => $id])->all();
                                $id_productos[] = $producto[0]['id'];
                                $ctd[] = $_POST['ctd'.$i.''];
                            }
                        }
                        $elemento = implode(",",$id_productos);
                        $cantidad = implode(",",$ctd);
                        $cafe = new TbComandas();
                        $cafe->id_productos = $elemento;
                        $cafe->ctd = $cantidad;
                        $cafe->id_usuario = $_POST['id_usuario'];
                        $cafe->id_mesa = $_POST['TbComandas']['id_mesa'];
                        $cafe->id_cliente = $cedula[0];
                        $cafe->status = 0;
                        foreach ($id_productos as $key => $value_pedido) {
                            if ( (int)$value_pedido<= 17) {
                                $cafe->status_cafe = 1;
                            }
                            if ((int)$value_pedido >= 18) {
                                 $cafe->status_cocina = 1;
                            }
                        }
                        $cafe->obs_expressos = $_POST['obs_expressos'];
                        $cafe->obs_lattes = $_POST['obs_lattes'];
                        $cafe->obs_bfrias = $_POST['obs_bfrias'];
                        $cafe->obs_energy = $_POST['obs_energy'];
                        $cafe->obs_shake = $_POST['obs_shake'];
                        $cafe->obs_fruits = $_POST['obs_fruits'];
                        $cafe->obs_paninis = $_POST['obs_paninis'];
                        $cafe->obs_salads = $_POST['obs_salads'];
                        $cafe->obs_hotcakes = $_POST['obs_hotcakes'];
                        $cafe->obs_cakes = $_POST['obs_cakes'];
                        $cafe->obs_deserts = $_POST['obs_deserts'];
                        $cafe->h_pedido = $_POST['h_pedido'];
                            $cafe->save(false);

                        $clientes = new TbClientes();
                            $clientes->cedula = $cedula[0];
                            $clientes->save(false);

                         $areaMesas = new TbMesas();
                            $areaMesas->id_comanda =  $cafe->id;
                            $areaMesas->h_entrada  =  $_POST['h_pedido'];
                            $areaMesas->save(false);

                        $areaCafe = new TbCafe();
                            $areaCafe->id_comanda =  $cafe->id;
                            $areaCafe->h_entrada  =  $_POST['h_pedido'];
                            $areaCafe->save(false);

                        $areaCocina = new TbCocina();
                            $areaCocina->id_comanda =  $cafe->id;
                            $areaCocina->h_entrada  =  $_POST['h_pedido'];
                            $areaCocina->save(false);

                    Yii::$app->session->setFlash('error', "El cliente con la Cédula N° ". $clientes->cedula." no se encuentra registrado, por favor no ólvide incluirlo");
                        return $this->redirect(['index']);
               }

        }

        return $this->render('create', [
            'model' => $model,
            'cafe'=> TbComandas::getCafe(),
            'lattes'=> TbComandas::getLattes(),
            'b_frias'=> TbComandas::getBfrias(),
            'energys' => TbComandas::getEnergys(),
            'shakes' => TbComandas::getShakes(),
            'fruits' =>  TbComandas::getfruits(),
            'clientes'=> TbComandas::getClientes(),
            'paninis' => TbComandas::getPaninis(),
            'ensaladas' => TbComandas::getEnsaladas(),
            'hotcakes' => TbComandas::getHotcakes(),
            'tortas' => TbComandas::getTortas(),
            'postres' => TbComandas::getPostres(),
        ]);
    }

    /**
     * Updates an existing TbComandas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $id_cliente, $id_productos)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $ced_post = (substr($_POST['cedula_cliente'],0,8));
            $cedula = explode(":", $ced_post);
            $consult = TbClientes::find()->where(['cedula' => $cedula[0]])->one();
            $count = count(TbProductos::find()->all());
               if (isset($consult)) {
                     for ($i=1; $i <= $count ; $i++) {
                          if($_POST['ctd'.$i.''] != 0){
                            $id = $i;
                            $producto = TbProductos::find()->where(['id' => $id])->all();
                            $id_productos2[] = $producto[0]['id'];
                            $ctd[] = $_POST['ctd'.$i.''];
                          }
                    }
                    $elemento = implode(",",$id_productos2);
                    $cantidad = implode(",",$ctd);
                        $cafe = TbComandas::find()->where(['id' => $model->id])->one();
                        $cafe->id_productos = $elemento;
                        $cafe->ctd = $cantidad;
                        $cafe->id_usuario = $_POST['id_usuario'];
                        $cafe->id_mesa = $_POST['TbComandas']['id_mesa'];
                        $cafe->id_cliente = $cedula[0];
                        $cafe->status = 0;
                        $cafe->save(false);
               }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'cafe'=> TbComandas::getCafe(),
            'lattes'=> TbComandas::getLattes(),
            'b_frias'=> TbComandas::getBfrias(),
            'energys' => TbComandas::getEnergys(),
            'shakes' => TbComandas::getShakes(),
            'fruits' =>  TbComandas::getfruits(),
            'clientes'=> TbComandas::getClientes(),
            'paninis' => TbComandas::getPaninis(),
            'ensaladas' => TbComandas::getEnsaladas(),
            'hotcakes' => TbComandas::getHotcakes(),
            'tortas' => TbComandas::getTortas(),
            'postres' => TbComandas::getPostres(),
        ]);
    }

    /**
     * Deletes an existing TbComandas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbComandas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbComandas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbComandas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionDespachocafe()
    {
        $model = $this->findModel($_GET['id']);
        $cafe_despacho = TbComandas::find()->where(['id' => $model->id])->one();
        
      
        if($cafe_despacho->status == 1){
            $cafe_despacho->status_cafe = 0;
            $cafe_despacho->save(false);
        }else{
            $cafe_despacho->status_cafe = 2;
            $cafe_despacho->save(false);
        }
        
        $cafe_entrega = TbCafe::find()->where(['id_comanda' => $model->id])->one();
            $cafe_entrega->h_salida = $_GET['h_salida'];
            $cafe_entrega->save(false);

        Yii::$app->session->setFlash('success', "Cafes de la mesa: ".$model->id." està listo");
                
        return $this->redirect(['index']);
        
    }
    public function actionDespachococina()
    {
        $model = $this->findModel($_GET['id']);
        $cocina_despacho = TbComandas::find()->where(['id' => $model->id])->one();
        if($cocina_despacho->status == 1){
            $cocina_despacho->status_cocina = 0;
            $cocina_despacho->save(false);
        }else{
            $cocina_despacho->status_cocina = 2;
            $cocina_despacho->save(false);
        }

        $cocina_entrega = TbCocina::find()->where(['id_comanda' => $model->id])->one();
            $cocina_entrega->h_salida = $_GET['h_salida'];
            $cocina_entrega->save(false);

        Yii::$app->session->setFlash('success', "Cocina de la mesa: ".$model->id." està listo");
        return $this->redirect(['index']);
        
    }
    public function actionTodolisto()
    {
        $model = $this->findModel($_GET['id']);
        $mesa_entrega = TbComandas::find()->where(['id' => $model->id])->one();
        $cafe = $mesa_entrega->status_cafe;
        $cocina = $mesa_entrega->status_cocina;
        if ($cafe == 2 || $cocina == 2) {
            $mesa_entrega->status= 1;
            $mesa_entrega->save(false);
        }

        $mesas_entrega = TbMesas::find()->where(['id_comanda' => $model->id])->one();
            $mesas_entrega->h_salida = $_GET['h_salida'];
            $mesas_entrega->save(false);

        Yii::$app->session->setFlash('success', "Pedidos de la mesa: ".$model->id." Entregado");
        return $this->redirect(['index']);
        
    }
}
