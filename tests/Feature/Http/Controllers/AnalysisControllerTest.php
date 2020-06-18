<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class AnalysisControllerTest extends TestCase
{
    use WithFaker;
    /**
     * @test
     */
    public function store_target()
    {
        // $response = $this->get('/');
        $user = factory(User::class)->create();

    //Acting as berfungsi sebagai autentikasi, jika kita menghilangkannya maka akan error.
    //  $this->actingAs($user)
    //  ->see($user->id);
    //Hit post ke method store, fungsinya ya akan lari ke fungsi store.
    $this->post('/api/addTarget',[
        'user_id' => $user->id,
        'bulan' => $this->faker->randomElement($array = array('Januari','Februari','Maret','April','Mei')),
        'tahun' => '2020',
        'jenis_cabai' => $this->faker->randomElement($array = array('Cabai rawit', 'Cabai keriting', 'Cabai besar')),
        'jumlah_cabai' => $this->faker->numberBetween($min = 20, $max=100),
    ]);

    //Tuntutan status 302, yang berarti redirect status code.
    $this->assertTrue(true);

    //Tuntutan bahwa abis melakukan POST URL akan dialihkan ke URL product atau routenya adalah product.index
    // $response->assertRedirect(route(''));
    // $request = $client->post('/addTarget', null, json_encode($data));
    // $response = $request->send();
    
    }
}
