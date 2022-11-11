# オレオレPHPフレームワーク & TDD & Vimで〇ちゃんねる

# ルール
- ライブラリを一切使わない
- Vimで開発する
- TDDする

# 仕様
## ページ
- トップページ
	+ スレッド一覧(各スレッドへのリンク)
- スレッド表示
	+ レスを時間昇順で表示
	+ 書き込み編集画面へのリンク
- レス編集画面
	+ 編集フォーム

## DBテーブル
- threads
	+ id
	+ name
	+ createdAt
- responses
	+ id
	+ threadId
	+ userName
	+ content
	+ createdAt

# アーキテクチャ
- Service
	+ Repositoryからデータを取得
	+ Viewにデータを突っ込んで返す
- Repository
	+ DBアクセスを担当
- View
	+ HTMLとテンプレートとしてのPHP
- Page
	+ URLで直接指定されるファイル
	+ 基本的にはService呼ぶだけ

