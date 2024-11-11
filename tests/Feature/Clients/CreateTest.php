<?php

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\UploadedFile;

it('client photo is stored when creating a client', function () {
    // Create a fake storage to upload the file
    Storage::fake();

    // Create a fake image file and upload it
    $file = UploadedFile::fake()->image('client.jpg');
    
    // create a user
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('admin/clients', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'photo' => $file
    ]);

    // Assert the data was stored in the database
    $this->assertDatabaseHas('clients', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
    ]);

    $client = Client::where('email', 'johndoe@example.com')->first();

    $this->assertNotNull($client->photo);

    // Assert the file was stored in the storage/app/public/clients directory
    Storage::assertExists("clients/$client->photo");

    Storage::fake();
});
