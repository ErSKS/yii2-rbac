<?php

namespace backend\modules\settings\controllers;

use Yii;
use backend\modules\settings\models\Authority;
use backend\modules\settings\models\Authority2;
// use backend\modules\settings\models\Authitem;
use backend\modules\settings\models\AuthoritySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\ErSKS;

/**
 * AuthorityController implements the CRUD actions for Authority model.
 */
class AuthorityController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ErSKS::getAccessRules(Yii::$app->controller->id);
    }
    public function actionSelect(){
        //echo "Nepal";exit;
        $model = new Authority2();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //echo "<pre>";print_r($model);exit;
            return $this->redirect(['assign', 'usergroup_id'=>$model->usergroup_id]);
        } else {
            return $this->render('select_group', [
                'model' => $model,
            ]);
        }
    }
    public function actionAssign() {
        
        $usergroup_id = $_GET['usergroup_id'];
        $data['usergroup_id'] = $usergroup_id;
        $model = new Authority();
        $data['model'] = $model;

        if (isset($_POST['Authority'])) {
            $model->attributes = $_POST['Authority'];
            // echo "<pre>";print_r($model);exit;
            $user = Yii::$app->user->identity;

            $postby_id = $verifiedby_id = $user->id;
            $sql = '';
            ob_start();
            $query = "INSERT INTO `authority` (`usergroup_id`,`authitem_id`,`is_access`,`postby_id`,`is_verified`,`verifiedby_id`,`is_active`) VALUES ";
            foreach ($_POST['Authority'] as $key => $value) {
                //echo "Key: ".$key.", Value: ".$value."<br>";
                $sql .= "('$usergroup_id','$key',1,'$postby_id',1,'$verifiedby_id',1),";
            }
            $query = $query . $sql;
            $query2 = rtrim($query, ",");
            //echo $query2;;exit;
            $connection = Yii::$app->getDb();
            $command = $connection->createCommand($query2);
            $command->execute();
            Yii::$app->session->setFlash('success',"Authorities assigned successfully.");
            return $this->redirect(['authority/assign','usergroup_id'=>2]);
            //exit;
        }

        /*if ($model->load(Yii::$app->request->post())){ 
            $model->attributes = $_POST['Authority'];           
            echo "<pre>";print_r($model->attributes);exit;
        }*/

        /*$criteria = new CDbCriteria();
        $criteria->addCondition("t.status = 1");
        $criteria->addCondition("t.access = 1");
        $criteria->addCondition("t.verified = 1");
        $criteria->addCondition("t.usergroup_id = '$usergroup_id'");
        //$criteria->addCondition("t.crn = :crn");
        //$criteria->params = array(":crn" => $crn);
        $data['d'] = Authority::model()->findAll($criteria);
        $data['usergroup_id'] = $usergroup_id;

        $model = new Authority;
        if (isset($_POST['Authority'])) {
            $model->attributes = $_POST['Authority'];
            if (!$_POST['Authority']) {
                $user = Yii::app()->getComponent('user');
                $user->setFlash(
                        'error', '<strong>Error!</strong> Change something and try submitting again.'
                );

                $this->redirect(array('authority/bulkassign'));
            }

            $postby_id = AdminFunctions::getUserInfo()->id;

            //Authorized User Posting data
            $controller = ucfirst($this->getUniqueId());
            $action = Yii::app()->controller->action->id;
            $access = $action . $controller;
            if (AdminFunctions::checkAccess("$access") == 1) {
                $verified = 1;
                $verifiedby_id = AdminFunctions::getUserInfo()->id;
                $status = 1;
            } else {
                echo "Authorized but Bypassed. Contact MIS Team #ASAP"; //exit;
            }
            $sql = '';
            ob_start();
            $query = "INSERT INTO `authority` (`usergroup_id`,`authitem_id`,`access`,`postby_id`,`verified`,`verifiedby_id`,`status`) VALUES ";

            foreach ($_POST['Authority'] as $key => $value) {
                //echo $key . "<br>";
                //$cid_sem = split("\_", $key);
                $sql .= "('$usergroup_id','$key',1,'$postby_id','$verified','$verifiedby_id','$status'),";
                //echo $sql . "<br/>";
                //echo $key . "(" . $cid_sem[0] . ", " . $cid_sem[1] . ") => " . $value . "<br>";
            }
            //exit;
            $query = $query . $sql;
            $query2 = rtrim($query, ",");
             echo $query2;        exit; 
            $connection = Yii::app()->db;
            $command = $connection->createCommand($query2);
            if ($command->execute()) {
                $user = Yii::app()->getComponent('user');
                $user->setFlash('success', '<strong>SUCCESS!!!</strong>, Authority(s) assigned successfully.');
                $data = array($usergroup_id);
                $this->redirect(array('authority/bulkassign/?data[usergroup_id]=' . $data[0]));
            } else {
                echo "Bypassed.";
                exit;
            }
        } */

        return $this->render('assign',$data);
    }

    /**
     * Lists all Authority models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthoritySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Authority model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Authority model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Authority();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Authority model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Authority model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Authority model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Authority the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Authority::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
