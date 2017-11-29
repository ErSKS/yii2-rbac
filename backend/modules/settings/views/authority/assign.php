<?php
// echo "Nepal";exit;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\models\Usergroup;
use yii\bootstrap\ActiveForm;
use backend\modules\settings\models\Authitem;

use yii\filters\ErSKS;


$this->title = 'Bulk Assign - Authorities';
$this->params['breadcrumbs'][] = ['label' => 'Rule Book', 'url' => ['/authority/select_group']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authority-create">

<h1><?= Html::encode($this->title)." to "; ?><span class="text-red"><?= Usergroup::findOne($usergroup_id)->title;?></span></h1>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
    $('#selectAll').click(function () {    
         $('input:checkbox').prop('checked', this.checked);    
     });
    });
</script>
	<input type="checkbox" id="selectAll"/>&nbsp;Select All Items
    <div class="authority-form">
    <?php $form = ActiveForm::begin([
        'id' => 'authority-form',
        'enableClientValidation' => true,
        'method'=>'post'
    ]); ?>
    <?= $form->errorSummary($model) ?>

    <?php $authitemController = Authitem::find()->groupBy('controller')->all();
    	//echo "<pre>";print_r($authitemController);    	
    ?>
	<table class="table table-striped">
		<?php foreach ($authitemController as $ac) {?>
		<tr>
			<td><?= ucfirst($ac['controller']);?></td>
		</tr>		
		<tr>
			<td>
    		<?php $associatedItems = Authitem::find()->where(['controller'=>$ac['controller']])->all();
    			foreach ($associatedItems as $items) {	
                $flag = ErSKS::isActionAssigned($items['id'],$usergroup_id);
                if ($flag == 1) {
                    $chk = "checked disabled readonly";
                }else{
                    $chk = " ";
                }			
    		?>
			<input <?= $chk;?> class="auth" type="checkbox" name="Authority[<?= $items['id'];?>]" value="Authority[<?= $items['id'];?>]"/>&nbsp;<span class="<?php if($flag==1){ echo 'text-red';}?>"><?= ucfirst($items['action']);?></span>&nbsp;&nbsp;
			<?php }?>
			</td>
		</tr>
		<?php }?>
	</table>     
    <div class="form-group">
        <label class="control-label col-sm-3">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? 'Assign Authorities' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>
