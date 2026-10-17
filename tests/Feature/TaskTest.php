<?php

use App\Models\Task;
use App\Models\User;

function validTaskPayload(array $overrides = []): array
{
    return array_merge([
        'name' => 'Test task',
        'description' => 'A description',
        'status' => 'doing',
        'priority' => 'high',
        'startTime' => '2026-01-01',
        'endTime' => '2026-01-05',
    ], $overrides);
}

test('guests are redirected from tasks index', function () {
    $this->get('/tasks')->assertRedirect('/login');
});

test('a user only sees their own tasks', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();

    Task::factory()->for($user)->create(['name' => 'Mine task']);
    Task::factory()->for($other)->create(['name' => 'Other task']);

    $this->actingAs($user)
        ->get('/tasks')
        ->assertOk()
        ->assertSee('Mine task')
        ->assertDontSee('Other task');
});

test('a user can create a task', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/tasks', validTaskPayload())
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseHas('tasks', [
        'name' => 'Test task',
        'user_id' => $user->id,
    ]);
});

test('task creation validates required fields', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/tasks', ['name' => 'Only name'])
        ->assertSessionHasErrors(['description', 'status', 'priority', 'startTime', 'endTime']);

    $this->assertDatabaseCount('tasks', 0);
});

test('task creation rejects an end time before the start time', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/tasks', validTaskPayload([
            'startTime' => '2026-02-10',
            'endTime' => '2026-02-01',
        ]))
        ->assertSessionHasErrors('endTime');
});

test('task creation rejects invalid enum values', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/tasks', validTaskPayload(['status' => 'bogus', 'priority' => 'urgent']))
        ->assertSessionHasErrors(['status', 'priority']);
});

test('a user can update their own task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create();

    $this->actingAs($user)
        ->put("/tasks/{$task->id}", validTaskPayload(['name' => 'Updated']))
        ->assertRedirect(route('tasks.index'));

    expect($task->fresh()->name)->toBe('Updated');
});

test('a user can delete their own task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create();

    $this->actingAs($user)
        ->delete("/tasks/{$task->id}")
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});

test('a user cannot view another users task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for(User::factory())->create();

    $this->actingAs($user)->get("/tasks/{$task->id}")->assertForbidden();
});

test('a user cannot update another users task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for(User::factory())->create();

    $this->actingAs($user)
        ->put("/tasks/{$task->id}", validTaskPayload(['name' => 'Hacked']))
        ->assertForbidden();

    expect($task->fresh()->name)->not->toBe('Hacked');
});

test('a user cannot delete another users task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for(User::factory())->create();

    $this->actingAs($user)
        ->delete("/tasks/{$task->id}")
        ->assertForbidden();

    $this->assertDatabaseHas('tasks', ['id' => $task->id]);
});
