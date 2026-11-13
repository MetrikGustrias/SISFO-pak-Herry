<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Tamu (belum login) diarahkan ke halaman login.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/')->assertRedirect(route('login'));
    }

    public function test_login_page_is_displayed(): void
    {
        $this->get('/login')->assertOk();
    }
}
