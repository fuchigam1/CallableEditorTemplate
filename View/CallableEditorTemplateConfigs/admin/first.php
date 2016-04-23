<?php
/**
 * [ADMIN] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
?>
<?php echo $this->BcForm->create('CallableEditorTemplateConfig', array('action' => 'first')) ?>
<?php echo $this->BcForm->input('CallableEditorTemplateConfig.active', array('type' => 'hidden', 'value' => '1')) ?>
<table cellpadding="0" cellspacing="0" class="form-table section" id="ListTable">
	<tr>
		<th class="col-head">
			はじめに<br />お読み下さい。
		</th>
		<td class="col-input">
			<strong>コーラブルエディターテンプレート設定データ作成では、各コンテンツ用のコーラブルエディターテンプレート設定データを作成します。</strong>
			<ul>
				<li>コーラブルエディターテンプレート設定データがないコンテンツ用のデータのみ作成します。</li>
			</ul>
		</td>
	</tr>
</table>

<div class="submit">
	<?php
	echo $this->BcForm->submit('作成する', array(
		'div'		 => false,
		'class'		 => 'btn-red button',
		'id'		 => 'BtnSubmit',
		'onClick'	 => "return confirm('コーラブルエディターテンプレート設定データの作成を行いますが良いですか？')"))
	?>
</div>
<?php echo $this->BcForm->end() ?>
