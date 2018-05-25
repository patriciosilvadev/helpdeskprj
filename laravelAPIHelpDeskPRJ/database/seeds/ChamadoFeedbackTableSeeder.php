<?php

use Illuminate\Database\Seeder;
use App\Models\Organizacao;
use App\Models\ChamadoFeedback;

class ChamadoFeedbackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ChamadoFeedback::class, 100)->create()->each(function($cf) {
            $organizacao = Organizacao::orderByRaw('RAND()')->first();
            $cf->organizacao()->save($organizacao);
        });
    }
}
