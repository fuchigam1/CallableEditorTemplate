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
<tr>
	<th>設定管理メニュー</th>
	<td>
		<ul>
			<li><?php $this->BcBaser->link('記事別エディターテンプレート呼出設定一覧', array('admin' => true, 'plugin' => 'callable_editor_template', 'controller' => 'callable_editor_template_configs', 'action' => 'index')) ?></li>
		</ul>
	</td>
</tr>
<?php if (!in_array($this->request->params['action'], array('admin_index', 'admin_add'))): ?>
	<?php if ($this->request->data['CallableEditorTemplateConfig']['model'] == 'Page'): ?>
		<tr>
			<th>固定ページ管理メニュー</th>
			<td>
				<ul>
					<li>
						<?php $this->BcBaser->link('記事一覧', array('admin' => true, 'plugin' => null, 'controller' => 'pages', 'action' => 'index')) ?>
					</li>
				</ul>
			</td>
		</tr>
	<?php endif ?>
	<?php if ($this->request->data['CallableEditorTemplateConfig']['model'] == 'BlogContent'): ?>
		<tr>
			<th>ブログコンテンツ管理メニュー</th>
			<td>
				<ul>
					<li><?php $this->BcBaser->link($blogContentDatas[$this->request->data['CallableEditorTemplateConfig']['content_id']] . ' ブログ設定編集', array('admin' => true, 'plugin' => 'blog', 'controller' => 'blog_contents', 'action' => 'edit', $this->request->data['CallableEditorTemplateConfig']['content_id'])) ?></li>
					<li><?php $this->BcBaser->link('記事一覧', array('admin' => true, 'plugin' => 'blog', 'controller' => 'blog_posts', 'action' => 'index', $this->request->data['CallableEditorTemplateConfig']['content_id'])) ?></li>
				</ul>
			</td>
		</tr>
	<?php endif ?>
<?php endif ?>
<tr>
	<th>エディタテンプレートメニュー</th>
	<td>
		<ul class="cleafix">
			<li><?php $this->BcBaser->link('エディタテンプレート一覧', array('plugin' => false, 'controller' => 'editor_templates', 'action' => 'index')) ?></li>
			<li><?php $this->BcBaser->link('エディタテンプレート新規追加', array('plugin' => false, 'controller' => 'editor_templates', 'action' => 'add')) ?></li>
		</ul>
	</td>
</tr>
