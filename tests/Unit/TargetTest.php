<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Tests\TestCase;

class TargetTest extends TestCase
{
    use WithFaker;
    /**
     * @test
     */
    public function showTarget()
    {
        $user = factory(User::class)->create();
        $data = [
            'user_id' => $user->id,
            'bulan' => $this->faker->randomElement($array = array('Januari','Februari','Maret','April','Mei')),
            'tahun' => '2020',
            'jenis_cabai' => $this->faker->randomElement($array = array('Cabai rawit', 'Cabai keriting', 'Cabai besar')),
            'jumlah_cabai' => $this->faker->numberBetween($min = 20, $max=100),
        ];
        $this->actingAs($user)
            // ->withSession(['foo' => 'bar'])
            // ->get('/produsen/target')
            // ->assertJson($user);
            // ->assertSee('Hello, '.$user->name);
        ->post(route('target.store'), $data)
        ->assertStatus(200);
        // $this->assertTrue(true);
        //  $this->post(route('posts.store'), $data)
        //     ->assertStatus(201)
        //     ->assertJson($data);
        // $data = [
        //     'title' => $this->faker->sentence,
        //     'content' => $this->faker->paragraph,
        // ];

        // $this->post(route('posts.store'), $data)
        //     ->assertStatus(201)
        //     ->assertJson($data);
    }
}
