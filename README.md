# php81-nginx-mariadb

PHP 8.1 / Nginx / MariaDB のDocker環境上で構築した、Laravel学習用アプリケーション(`my-app`)です。
Eloquent・認可(Policy)・認証(Breeze / GitHub OAuth)・メール送信・ファイルアップロードなど、Laravelの主要な機能をひと通り実装しています。

![Laravel](https://img.shields.io/badge/Laravel-10-brightgreen.svg)
![PHP](https://img.shields.io/badge/PHP-8.1-blue.svg)
![MariaDB](https://img.shields.io/badge/MariaDB-10.4-blue.svg)
![nginx](https://img.shields.io/badge/nginx-1.18-blue.svg)
![Docker](https://img.shields.io/badge/Docker-20.10-blue.svg)

## 主な機能

- 投稿のCRUD(作成・一覧・詳細・編集・削除)、ソフトデリート対応
- 投稿への複数画像アップロード(Swiperスライダー表示)
- 投稿へのタグ付け(多対多リレーション)
- 会員登録・ログイン・パスワードリセット・プロフィール編集(Laravel Breeze)
- GitHub OAuthログイン
- メールアドレス確認(Mailtrap経由で送信、スケジュールタスクとして`app:send-verification-emails`を実行)
- 管理者専用ログイン・ダッシュボード(`/admin`、一般ユーザーとは別テーブル`admins`で管理)
- 投稿の作成者本人のみ編集・削除できる権限制御(`PostPolicy`)

## 技術構成

| 項目 | 内容 |
|---|---|
| バックエンド | PHP 8.1 / Laravel 10 |
| DB | MariaDB |
| Webサーバー | Nginx |
| フロントエンド | Blade / Tailwind CSS / Vite |
| メール送信(開発時) | Mailtrap Sandbox |
| コンテナ | Docker / docker compose |

## セットアップ手順

### 1. clone

```bash
git clone https://github.com/FUFU222/php81-nginx-mariadb.git
cd php81-nginx-mariadb
```

### 2. 環境変数ファイルを用意する

DB用(docker-compose用)とアプリ用(Laravel用)、2箇所に`.env`が必要です。

```bash
cp .env.example .env
cp my-app/.env.example my-app/.env
```

- ルートの`.env`: MariaDBのユーザー名・パスワードなど。開発用の値を自由に決めて設定してください。
- `my-app/.env`: `DB_*`はルートの`.env`と同じ値に、`APP_KEY`は後述の手順で自動生成します。
- GitHubログインを試す場合は、[GitHub Developer Settings](https://github.com/settings/developers)でOAuth Appを作成し、`GITHUB_CLIENT_ID` / `GITHUB_CLIENT_SECRET` / `GITHUB_REDIRECT_URI`を設定してください。
- メール送信を試す場合は、[Mailtrap](https://mailtrap.io)のSandbox用SMTP情報を`MAIL_*`に設定してください(未設定でも他の機能は動作します)。

### 3. コンテナ起動

```bash
docker compose up -d
```

- Nginx: http://localhost:81
- Vite (dev server): http://localhost:5173

### 4. 依存パッケージのインストール・初期化

```bash
docker compose exec web bash -c "cd /var/www/my-app && composer install"
docker compose exec web bash -c "cd /var/www/my-app && php artisan key:generate"
docker compose exec web bash -c "cd /var/www/my-app && php artisan migrate"
docker compose exec web bash -c "cd /var/www/my-app && php artisan storage:link"
docker compose exec web bash -c "cd /var/www/my-app && npm install && npm run build"
```

ここまで完了すれば http://localhost:81 でアプリが動作します。

### 5. (任意) ダミーデータの投入

```bash
docker compose exec web bash -c "cd /var/www/my-app && php artisan db:seed"
```

### 6. (任意) メール確認バッチの実行

未認証ユーザーへ確認メールを送るコマンドです。手動実行、またはcronから`schedule:run`を毎分呼び出すか、開発中は`schedule:work`で疑似デーモンとして動かせます。

```bash
docker compose exec web bash -c "cd /var/www/my-app && php artisan app:send-verification-emails"
```

## ディレクトリ構成

```
.
├── docker-compose.yml       # web(PHP-FPM) / nginx / mariadb の3コンテナ構成
├── docker-config/           # 各コンテナのDockerfile・設定ファイル
└── my-app/                  # Laravelアプリケーション本体
```
