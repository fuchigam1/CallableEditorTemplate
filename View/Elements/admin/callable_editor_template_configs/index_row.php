<?php
/**
 * [ADMIN] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
$classies = array();
if (!$this->CallableEditorTemplate->allowPublish($data)) {
	$classies = array('unpublish', 'disablerow');
} else {
	$classies = array('publish');
}
$class=' class="'.implode(' ', $classies).'"';
?>
<tr<?php echo $class; ?>>
	<td class="row-tools">
	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_unpublish.png', array('alt' => '無効', 'class' => 'btn')),
			array('action' => 'ajax_unpublish', $data['CallableEditorTemplateConfig']['id']), array('title' => '無効', 'class' => 'btn-unpublish')) ?>
	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_publish.png', array('alt' => '有効', 'class' => 'btn')),
			array('action' => 'ajax_publish', $data['CallableEditorTemplateConfig']['id']), array('title' => '有効', 'class' => 'btn-publish')) ?>

	<?php if($this->CallableEditorTemplate->isNotDelete($data)): ?>
		<?php // ブログ設定編集画面へ移動 ?>
		<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_check.png', array('alt' => 'ブログ設定編集', 'class' => 'btn')),
			array('admin' => true, 'plugin' => 'blog', 'controller' => 'blog_contents', 'action' => 'edit', $data['CallableEditorTemplateConfig']['content_id']), array('title' => 'ブログ設定編集')) ?>
	<?php else: ?>
		<?php // 固定ページ一覧画面へ移動 ?>
		<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_check.png', array('alt' => '固定ページ一覧', 'class' => 'btn')),
			array('admin' => true, 'plugin' => null, 'controller' => 'pages', 'action' => 'index'), array('title' => '固定ページ一覧')) ?>
	<?php endif ?>

	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_edit.png', array('alt' => '編集', 'class' => 'btn')),
			array('action' => 'edit', $data['CallableEditorTemplateConfig']['id']), array('title' => '編集')) ?>
	
	<?php if($this->CallableEditorTemplate->isNotDelete($data)): ?>
		<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_delete.png', array('alt' => '削除', 'class' => 'btn')),
			array('action' => 'ajax_delete', $data['CallableEditorTemplateConfig']['id']), array('title' => '削除', 'class' => 'btn-delete')) ?>
	<?php endif ?>
	</td>
	<td style="width: 45px;"><?php echo $data['CallableEditorTemplateConfig']['id']; ?></td>
	<td>
		<?php echo $this->BcBaser->link($blogContentDatas[$data['CallableEditorTemplateConfig']['content_id']],
			array('action' => 'edit', $data['CallableEditorTemplateConfig']['id']),
			array('title' => '編集')
		) ?>
	</td>
	<td>
		<?php echo $this->BcBaser->link($data['CallableEditorTemplateConfig']['title'],
			array('action' => 'edit', $data['CallableEditorTemplateConfig']['id']),
			array('title' => '編集')
		) ?>
	</td>
	<td>
		<?php echo $this->BcText->arrayValue($data['CallableEditorTemplateConfig']['auto_display'], $this->BcText->booleanMarkList()) ?>
	</td>
	<td style="white-space: nowrap">
		<?php echo $this->BcTime->format('Y-m-d', $data['CallableEditorTemplateConfig']['created']) ?>
		<br />
		<?php echo $this->BcTime->format('Y-m-d', $data['CallableEditorTemplateConfig']['modified']) ?>
	</td>
</tr>
