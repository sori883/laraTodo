---
weight: 1
bookFlatSection: true
title: "laravelセットアップ"
---

# laravelのセットアップ
DBやmailhogへ接続するために設定を行う。

## .envファイルの作成
.env.exampleをコピーし、.envファイルを作成する。  
必要な設定値のみ下記の通り変更。  

```
APP_NAME=laratodo

DB_CONNECTION=pgsql
DB_HOST=postgresql
DB_PORT=5432
DB_DATABASE=laratodo
DB_USERNAME=default
DB_PASSWORD=seclet

MAIL_DRIVER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=hoge
MAIL_PASSWORD=password
MAIL_ENCRYPTION=null
MAIL_FROM_NAME=hoge
MAIL_FROM_ADDRESS=no-reply@example.com

APP_FAKER_LOCALE=ja_JP
```