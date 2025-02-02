<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    public function test_a_user_as_many_posts()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(Collection::class, $user->posts);
    }
}
