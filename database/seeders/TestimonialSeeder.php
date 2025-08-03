<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Testimonial::insert([
            [
                'id'          => 1,
                'type'        => 'Catering',
                'description' => '<p>Voor meerdere bedrijven gewerkt te hebben moet ik zeggen dat Fourparties er met kop en schouder boven uit steekt. Naast de professionele aanpak, maar toch fijne manier van communicatie is het ook zo dat de werknemer er zich erg gewaardeerd voelt. Zoeken naar een baan in de horeca, dan kan het zoeken denk ik stoppen!</p>',
                'name'        => 'Koen',
                'rating'      => 5,
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '10', '55', '30'),
                'updated_at'  => Carbon::create('2024', '06', '24', '10', '55', '30'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 2,
                'type'        => 'Logistics',
                'description' => '<p>Superleuk uitzendbureau om te werken! Diverse klussen, leuke en verschillende collega\'s waardoor het nooit saai wordt. Je hebt erg veel vrijheid. Zo kun je zelf je beschik baarheid opgeven en je werktijden bepalen. Hard werken wordt beloond door middel van een salarisschalen systeem.</p>',
                'name'        => 'Antonella',
                'rating'      => 5,
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '10', '57', '02'),
                'updated_at'  => Carbon::create('2024', '06', '24', '10', '57', '02'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 3,
                'type'        => 'Facility Services',
                'description' => '<p>Voor meerdere bedrijven gewerkt te hebben moet ik zeggen dat Fourparties er met kop en schouder boven uit steekt. Naast de professionele aanpak, maar toch fijne manier van communicatie is het ook zo dat de werknemer er zich erg gewaardeerd voelt. Zoeken naar een baan in de horeca, dan kan het zoeken denk ik stoppen!</p>',
                'name'        => 'Justus',
                'rating'      => 5,
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '10', '58', '27'),
                'updated_at'  => Carbon::create('2024', '06', '24', '10', '58', '27'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 4,
                'type'        => 'Catering',
                'description' => '<p>Voor meerdere bedrijven gewerkt te hebben moet ik zeggen dat Fourparties er met kop en schouder boven uit steekt. Naast de professionele aanpak, maar toch fijne manier van communicatie is het ook zo dat de werknemer er zich erg gewaardeerd voelt. Zoeken naar een baan in de horeca, dan kan het zoeken denk ik stoppen!</p>',
                'name'        => 'Koen',
                'rating'      => 5,
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '10', '59', '30'),
                'updated_at'  => Carbon::create('2024', '06', '24', '10', '59', '30'),
                'deleted_at'  => null,
            ],
        ]);
    }
}
