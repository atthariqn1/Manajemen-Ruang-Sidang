<?php

namespace Tests\Feature;

use App\Models\RuangSidang;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RuangSidangTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        if (! extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('The pdo_sqlite extension is required for database tests.');
        }

        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_it_displays_the_ruang_sidang_index_page(): void
    {
        RuangSidang::create([
            'kode_ruang' => 'R. Sidang 101',
            'gedung' => 'Gedung Utama',
            'kapasitas' => 20,
            'fasilitas' => ['Proyektor', 'AC'],
            'keterangan' => 'Ruang utama ujian',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('R. Sidang 101');
        $response->assertSee('Gedung Utama');
        $response->assertSee('20 Orang');
    }

    public function test_it_stores_a_room_and_its_facilities_as_an_array(): void
    {
        $response = $this->post('/ruang-sidang', [
            'kode_ruang' => 'R. Sidang 301',
            'gedung' => 'Gedung Rektorat Lt. 3',
            'kapasitas' => 15,
            'fasilitas' => ['Proyektor', 'AC'],
            'keterangan' => 'Kondisi baik',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');

        $ruangSidang = RuangSidang::query()->firstOrFail();

        $this->assertSame('R. Sidang 301', $ruangSidang->kode_ruang);
        $this->assertSame(15, $ruangSidang->kapasitas);
        $this->assertSame(['Proyektor', 'AC'], $ruangSidang->fasilitas);
        $this->assertSame('Kondisi baik', $ruangSidang->keterangan);
    }

    public function test_it_saves_an_empty_facilities_array_when_no_checkbox_is_selected(): void
    {
        $this->post('/ruang-sidang', [
            'kode_ruang' => 'R. Sidang 302',
            'gedung' => 'Gedung Rektorat Lt. 3',
            'kapasitas' => 10,
        ])->assertRedirect('/');

        $this->assertSame([], RuangSidang::query()->firstOrFail()->fasilitas);
    }

    public function test_it_rejects_an_invalid_facility_value(): void
    {
        $response = $this->from('/')->post('/ruang-sidang', [
            'kode_ruang' => 'R. Sidang 303',
            'gedung' => 'Gedung Rektorat Lt. 3',
            'kapasitas' => 10,
            'fasilitas' => ['Peralatan tidak dikenal'],
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('fasilitas.0');
        $this->assertDatabaseCount('ruang_sidangs', 0);
    }

    public function test_it_can_update_a_ruang_sidang(): void
    {
        $ruang = RuangSidang::create([
            'kode_ruang' => 'R. Sidang 102',
            'gedung' => 'Gedung A',
            'kapasitas' => 10,
            'fasilitas' => ['AC'],
            'keterangan' => 'Catatan lama',
        ]);

        $response = $this->put("/ruang-sidang/{$ruang->id}", [
            'kode_ruang' => 'R. Sidang 102 (Revisi)',
            'gedung' => 'Gedung A Lt. 2',
            'kapasitas' => 12,
            'fasilitas' => ['AC', 'PC Sidang'],
            'keterangan' => 'Catatan baru',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');

        $ruang->refresh();
        $this->assertSame('R. Sidang 102 (Revisi)', $ruang->kode_ruang);
        $this->assertSame(12, $ruang->kapasitas);
        $this->assertSame(['AC', 'PC Sidang'], $ruang->fasilitas);
    }

    public function test_it_can_delete_a_ruang_sidang(): void
    {
        $ruang = RuangSidang::create([
            'kode_ruang' => 'R. Sidang 999',
            'gedung' => 'Gedung Hapus',
            'kapasitas' => 5,
            'fasilitas' => [],
        ]);

        $response = $this->delete("/ruang-sidang/{$ruang->id}");

        $response->assertRedirect('/');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('ruang_sidangs', ['id' => $ruang->id]);
    }
}
