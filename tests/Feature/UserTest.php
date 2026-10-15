<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    // テスト1：ユーザー作成が成功するか
    public function test_user_can_be_created(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => $user->email,
        ]);
    }

    // テスト2：同じメールアドレスを登録できないか
    public function test_duplicate_email_throws_exception(): void
    {
        $user = User::factory()->create();

        $this->expectException(QueryException::class);

        User::factory()->create([
            'email' => $user->email,
        ]);
    }
}
