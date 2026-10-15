# testing-app-practice

## 概要

COACHTECH 教材「Tutorial 10-5 テスト ハンズオン演習」で作成したLaravelのテスト課題です。

Laravelのテスト機能を使用して、ユーザー作成処理が正常に動作するか、また同じメールアドレスでユーザーを重複登録できないかを確認しました。

## 使用技術

- PHP
- Laravel
- PHPUnit
- MySQL
- Docker / Laravel Sail
- Eloquent ORM
- Factory

## 実装したテスト

### 1. ユーザー作成テスト（正常系）

`User::factory()->create()` を使用してテスト用ユーザーを作成しました。

`assertDatabaseHas()` を使い、作成したユーザーのIDとメールアドレスがデータベースに保存されていることを確認しました。

**テスト結果：PASS**

### 2. メールアドレス重複テスト（異常系）

最初にユーザーを作成し、同じメールアドレスを持つ2人目のユーザーを登録しようとするテストを作成しました。

`expectException()` を使用して、データベースの一意制約による `QueryException` が発生することを確認しました。

**テスト結果：PASS**

## 学んだこと

- PHPUnitを使用すると、プログラムが正しく動作するかを自動で確認できることを学びました。
- Factoryを使うことで、テスト用のユーザーデータを簡単に作成できることを学びました。
- `RefreshDatabase` を使用すると、テストごとにデータベースを初期状態に戻せることを学びました。
- 正常な処理だけでなく、エラーが発生する場合もテストすることが重要だと分かりました。

## 動作確認

Laravel SailでDockerコンテナを起動します。

```bash
./vendor/bin/sail up -d
```

以下のコマンドでテストを実行します。

```bash
./vendor/bin/sail artisan test --filter=UserTest
```

### テスト実行結果

```text
PASS  Tests\Feature\UserTest

✓ user can be created
✓ duplicate email throws exception

Tests: 2 passed (2 assertions)
Duration: 0.48s
```

正常系・異常系の両方のテストが成功しました。

## 工夫したこと

- テストを正常系と異常系に分けて、何を確認しているのか分かりやすくしました。
- Factoryを使ってテスト用データを作成し、手動でユーザーを登録する必要がないようにしました。
- `RefreshDatabase` を使用して、テスト同士がデータベースの状態に影響されないようにしました。
