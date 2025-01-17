<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_post()
    {
        //authenticae a user
        $this->authenticate();

        //create a post using that user
        $postData = Post::factory()->raw(['user_id' => auth()->id()]);

        $post = $this->post("api/posts", $postData)->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('posts', $postData);

    }

    public function test_a_user_can_edit_a_post()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $postData = Post::factory()->raw(['user_id' => $post->user->id]);

        $this->actingAs($post->user)
            ->patch($post->path(), $postData)
            ->assertStatus(Response::HTTP_OK)->assertSee($postData['title']);

        $this->assertDatabaseHas('posts', $postData);

    }

    public function test_a_user_can_view_a_post()
    {
        $post = Post::factory()->create();

        $this->actingAs($post->user)->get($post->path())
            ->assertStatus(Response::HTTP_OK)
            ->assertSee($post->content)
            ->assertSee($post->title);

    }

    public function test_a_user_can_delete_a_post()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $this->actingAs($post->user)->delete($post->path())
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing(Post::class, $post->toArray());

    }


    public function test_a_guest_cannot_delete_post()
    {
        $post = Post::factory()->create();

        $user = $this->authenticate();

        $this->delete($post->path())
            ->assertStatus(Response::HTTP_FORBIDDEN)
        ;
        $this->assertDatabaseCount(Post::class, 1);

        //if user is not post owner
        $this->actingAs($user)->delete($post->path())
            ->assertStatus(Response::HTTP_FORBIDDEN)
        ;

    }
    public function test_a_user_can_view_all_posts()
    {
        $post = Post::factory()->create();

        $this->actingAs($post->user)->get('/api/posts')->assertSee($post->title);

    }



    // public function test_guests_cannot_view_posts(): void
    // {
    //     $response = $this->get('/api/posts');

    //     $response->assertStatus(Response::HTTP_FOUND);
    // }

}
