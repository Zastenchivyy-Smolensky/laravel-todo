<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @test
     */
    public function 一覧を取得できる()
    {
        $tasks = Task::factory()->count(10)->create();
        $response = $this->getJson("api/tasks");
        $response
        ->assertOk()
        ->assertJsonCount($tasks->count());
    }
    /**
     * @test
     */
    public function 登録することができる()
    {
        $data = [
            "title" => "テスト投稿"
        ];
        $response = $this->postJson("api/tasks",$data);
        $response
            ->assertCreated()
            ->assertJsonFragment($data);
    }

     /**
     * @test
     */
    public function 編集をテストする()
    {
       $task = Task::factory()->create();
       $task->title = "置き換え";
       $response = $this->patchJson("api/tasks/{$task->id}", $task->toArray());
       $response 
            ->assertOk()
            ->assertJsonFragment($task->toArray());
    }
    /**
     * @test
     */
    public function 削除することできる(){
        $task = Task::factory()->count(10)->create();
        $response = $this0>deleteJson("api/tasks/1");
        $response->assertOk();

        $response = $this->getJson("api/tasks");
        $response->assertJsoncount($tasks0>count()-1);
    }

     /**
     * @test
     */
    public function タイトルのからの場合は登録することができない()
    {
        $data = [
            "title" => ""
        ];
        $response = $this->postJson("api/tasks",$data);
        // dd($response->json());
        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                "title"=>"The title field is required."
            ]);
    }
}
