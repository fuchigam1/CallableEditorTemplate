# 記事別エディターテンプレート呼出 プラグイン

記事別エディターテンプレート設定 プラグインは、記事毎にエディタテンプレート設定欄を追加できるbaserCMS専用のプラグインです。
- [Summary: Wiki](https://github.com/materializing/CallableEditorTemplate/wiki)


## Installation

1. 圧縮ファイルを解凍後、BASERCMS/app/plugins/CallableEditorTemplate に配置します。
2. 管理システムのプラグイン管理に入って、表示されている 記事別エディターテンプレート呼出プラグイン をインストールして下さい。
3. インストール直後は、入力欄表示は無効化されているので、システムナビ＞記事別エディターテンプレート呼出 プラグイン＞記事別エディターテンプレート呼出設定一覧 にアクセスし、利用コンテンツ毎に有効化してください。
4. 有効化した固定ページ編集画面 or ブログ記事編集画面にアクセスすると、入力項目にエディターテンプレート設定欄が追加されてます。


## Uses

### 自動表示が有効の場合

フロント側では、記事編集画面内のエディターテンプレート設定欄で選択したエディタテンプレートが表示されます。

### 自動表示が無効の場合

記事詳細画面の任意の場所に、以下のコードを利用すること表示できます。

```
<?php // ブログ記事詳細テンプレートの場合 ?>
<?php echo $this->CallableEditorTemplate->getEditorTemplate($post); ?>
```

```
<?php // 固定ページの場合 ?>
<?php echo $this->CallableEditorTemplate->getEditorTemplate($this->request->data); ?>
```


## Bug reports, Discuss, Support

- Join online chat at [![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/materializing/CallableEditorTemplate?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)
- [Issue](https://github.com/materializing/CallableEditorTemplate/issues)


## Thanks

- [http://basercms.net/](http://basercms.net/)
- [http://wiki.basercms.net/](http://wiki.basercms.net/)
- [http://cakephp.jp](http://cakephp.jp)
- [Semantic Versioning 2.0.0](http://semver.org/lang/ja/)
