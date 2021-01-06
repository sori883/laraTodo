---
weight: 1
bookFlatSection: true
title: "postgresqlセットアップ"
---

# Postgresqlのセットアップ
DB・マイグレーション・テストデータのインサートを行います。

## DB作成
```
// psqlにログイン
cd laradock
docker-compose exec workspace psql -U default -h postgresql

// db作成
create database laratodo;
```

## マイグレーション
```
docker-compose exec workspace php artisan migrate
```

## テストデータ挿入
```
docker-compose exec workspace php artisan db:seed
```