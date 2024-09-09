<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test create a new task item.
     *
     * @return void
     */
    public function test_create_task()
    {
        // Create a category
        $category = Category::factory()->create();

        // Send a post request to create a new user and task items
        $response = $this->post(route('todo.submit'), [
            'name' => 'John Doe',
            'username' => 'john_doe',
            'email' => 'john@example.com',
            'todo-title' => ['Test Task'], // Title for the task
            'category' => [$category->id], // Use the created category ID
        ]);

        // Assert that the response is successful
        $response->assertStatus(200); // Assuming JSON response with 200 status code
        $response->assertJson(['message' => 'Data berhasil disimpan!']); // Check for success message

        // Retrieve the user and assert that it was created
        $user = User::where('email', 'john@example.com')->first();
        $this->assertNotNull($user); // Ensure user is not null

        // Assert that the task was created and the response is successful
        $this->assertDatabaseHas('tasks', [
            'user_id' => $user->id, // Check the task's user_id
            'description' => 'Test Task',
            'category_id' => $category->id,
        ]);
    }



    /**
     * Test updating a task item.
     *
     * @return void
     */
    public function test_update_task()
    {
        // Create a category and a task
        $category = Category::factory()->create();
        $task = Task::factory()->create(['category_id' => $category->id]);

        // Send a put request to update the task item
        $response = $this->put(route('tasks.update', $task->id), [
            'description' => 'Updated Task',
            'category_id' => $category->id,
        ]);

        // Assert that the task was updated
        $response->assertStatus(302); // Assuming a redirect after successful update
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'description' => 'Updated Task',
        ]);
    }

    /**
     * Test deleting a task item.
     *
     * @return void
     */
    public function test_delete_task()
    {
        // Create a task to delete
        $task = Task::factory()->create();

        // Send a delete request to remove the task item
        $response = $this->delete(route('tasks.destroy', $task->id));

        // Assert that the response redirects correctly
        $response->assertStatus(302); // Redirect status

        // Assert that the task was deleted
        $this->assertSoftDeleted('tasks', [
            'id' => $task->id,
        ]);
        

        // Assert that the session has a success message
        $response->assertSessionHas('success', 'Task berhasil dihapus');
    }


    /**
     * Test reading a list of task items.
     *
     * @return void
     */
    public function test_read_tasks()
    {
        // Create a task item
        $task = Task::factory()->create();

        // Send a get request to fetch the task list
        $response = $this->get(route('tasks.index'));

        // Assert that the response contains the created task item
        $response->assertSee($task->description);
    }
}
