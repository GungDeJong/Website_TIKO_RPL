<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTiketClassTest extends TestCase
{
    public function testStatusInactive()
    {
        $yourObject = new Tiket(); // Gantilah dengan nama kelas yang sesuai
        $yourObject->setStatus(0); // Gantilah dengan metode yang sesuai untuk mengatur status
        $this->assertEquals('<span class="badge badge-warning">Tidak Aktif</span>', $yourObject->status());
    }

    public function testStatusActive()
    {
        $yourObject = new YourClassName();
        $yourObject->setStatus(1);
        $this->assertEquals('<span class="badge badge-success">Aktif</span>', $yourObject->status());
    }

    public function testStatusUsed()
    {
        $yourObject = new YourClassName();
        $yourObject->setStatus(2);
        $this->assertEquals('<span class="badge badge-danger">Sudah Dipakai</span>', $yourObject->status());
    }

    public function testStatusExpired()
    {
        $yourObject = new YourClassName();
        $yourObject->setStatus(3);
        $this->assertEquals('<span class="badge badge-info">kedaluwarsa</span>', $yourObject->status());
    }

    public function testStatusRefund()
    {
        $yourObject = new YourClassName();
        $yourObject->setStatus(4);
        $this->assertEquals('<span class="badge badge-primary">Pengembalian Dana</span>', $yourObject->status());
    }
}
