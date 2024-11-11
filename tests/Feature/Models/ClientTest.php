<?php

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
    $response->assertRedirect(route('dashboard'));
});
