# お問い合わせフォーム

## 環境構築
Dockerビルド
  1. git@github.com:Estra-Coachtech/laravel-docker-template.git
  2. docker compose up -d -build

  *MySQLは、OSによって起動しない場合があるので、それぞれのPCに合わせてdocker-compose.ymlファイルを
  編集してください。

Laravel環境構築
  1. docker compose exec php bash
  2. composer install
  3. .env.exampleファイルから.envを作成し、環境変数を変更
  4. php artisan key:generate
  5. php artisan migrate
  6. php artisan db:seed
  
##使用技術（実行環境）
- PHP 8.x
- Laravel 10.x
- MySQL 8.x
  
##URL　
・開発環境 : http://localhost/
・phpMyAdmin : http//localhost:8080/
 
