<?php

namespace Tests\Feature;

use App\Events\ChatMessage;
use App\User;
use Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatMessagesControllerTest extends TestCase
{
    /**
     * @test
     */
    public function logged_user_can_add_message_to_chat()
    {
        Event::fake();

        $logged_user = factory(User::class)->create();

        $response = $this->actingAs($logged_user)->post('/chat_message', [

            'body' => 'Missatge de prova'

        ]);

        $response->assertSuccessful();


        Event::assertDispatched(ChatMessage::class, function ($e) {

            return $e->message === 'Missatge de prova';

        });
    }
}
