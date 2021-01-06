---
weight: 1
bookFlatSection: true
title: "laradockセットアップ"
---

# LaraDockのセットアップ

## 設定ファイルの作成

LaraDockフォルダ内のenv-exampleをコピーし、.envファイルを作成し、  
必要な設定値のみ下記の通り変更。  

```
APP_CODE_PATH_HOST=../laravel
DATA_PATH_HOST=../data
COMPOSE_PROJECT_NAME=laratodo
```

## コンテナ作成
下記コマンドを実行
```
cd laradock
docker-compose up -d postgresql nginx workspace php-fpm mailhog
```