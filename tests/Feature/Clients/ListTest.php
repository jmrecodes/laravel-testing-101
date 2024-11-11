<?php

use App\Models\User;

it('has a client list page', function() {
    // create a user 
    $user = User::factory()->create();

    // go to that page with the user authenticated
    $response = $this->actingAs($user)->get('/admin/clients');

    // assert that the page was successful
    $response->assertStatus(200);
});

it('has to be authenticated', function() {
    $response = $this->get('/admin/clients');

    $response->assertStatus(302)->assertRedirect('/login');
});