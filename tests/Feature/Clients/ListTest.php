<?php
// Example only
it('has clients/listtest.php page', function () {
    $response = $this->get('/clients/listtest.php');

    $response->assertStatus(200);
});
