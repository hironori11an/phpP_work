# BookSpace
---
# 概要   
本のレビューを投稿し、読書レビューを共有できるアプリです。
---
# URL
http://18.178.20.64/
---
# 機能一覧
### ホーム
- ログイン機能
- ユーザ登録
- レビュー検索
### ログインユーザ用機能
- レビュー登録
- マイページ
  - 登録したレビューの一覧表示
  - いいねしたレビューの一覧表示、いいねの取消
  - 登録したレビューのジャンル・著者別のグラフ表示
- レビュー検索、いいね登録
- レビューに対してコメント

---
# 使用技術   
- フロントサイド   
  - jquery
- バックエンド
  - php 7.3
  - laravel 5.7
- DB
  -mysql 5.7
- インフラ
  - Docker,docker-compose
  - AWS
    - VPC
    - EC2
    - RDS(mysql)
    - S3
  - CircleCI
    - テスト
    - デプロイ
---
# インフラ構成図
![インフラ構成図](https://github.com/hironori11an/phpP_work/tree/master/src/infra-config.png)
