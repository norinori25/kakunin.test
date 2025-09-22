# Copilot Instructions for This Laravel Docker Project

## プロジェクト概要
- このリポジトリは Laravel アプリケーションを Docker で開発・運用するためのテンプレートです。
- アプリ本体は `src/` ディレクトリ配下にあり、Laravel 標準の構成を踏襲しています。
- Docker 関連ファイルは `docker/` ディレクトリにまとめられています。

## 主要ディレクトリ・ファイル
- `src/` : Laravel アプリ本体
  - `app/` : コアロジック（MVC 構成）
  - `routes/` : ルーティング定義
  - `database/` : マイグレーション・シーダ・ファクトリ
  - `public/` : ドキュメントルート
  - `config/` : 設定ファイル
- `docker/` : Docker 構成
  - `php/` : PHP コンテナ用 Dockerfile, php.ini
  - `nginx/` : Nginx 設定
  - `mysql/` : MySQL 設定・データ永続化
- `docker-compose.yml` : サービス全体の起動・連携定義

## 開発ワークフロー
- **起動**: `docker-compose up -d` で全サービス起動
- **停止**: `docker-compose down`
- **マイグレーション**: `docker-compose exec app php artisan migrate`
- **テスト**: `docker-compose exec app php artisan test` または `phpunit`
- **依存追加**: `docker-compose exec app composer require <package>`

## プロジェクト固有の注意点
- Laravel のコード・設定は必ず `src/` 配下で管理
- DB データは `docker/mysql/data/` で永続化
- PHP バージョンや拡張は `docker/php/Dockerfile` で管理
- Nginx のルーティングは `docker/nginx/default.conf` を参照
- Laravel の `.env` は `src/.env` に配置

## コーディング規約・パターン
- Laravel 標準の MVC, Service, Repository パターンを推奨
- コントローラは `app/Http/Controllers/`、モデルは `app/Models/` に配置
- マイグレーション・シーダは `database/migrations/`, `database/seeders/` に配置
- ルートは `routes/web.php` (Web), `routes/api.php` (API) を使い分け

## 参考
- [Laravel 公式ドキュメント](https://laravel.com/docs)
- [Docker 公式ドキュメント](https://docs.docker.com/)

---

このファイルは AI コーディングエージェント向けのガイドです。プロジェクト固有の構成・運用・コーディングパターンを優先して反映してください。
