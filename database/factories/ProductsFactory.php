<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Daftar nama alat musik dan alat elektronik
        $musicalInstruments = [
            'Piano', 'Gitar', 'Biola', 'Drum', 'Saksophone', 'Flute', 'Gong', 'Harmonika', 'Trumpet', 'Sitar'
        ];

        $electronicDevices = [
            'Gitar Elektrik', 'Keyboard', 'Drum Elektrik', 'Synthesizer', 'Metronome', 'Audio Interface', 'Mixer', 'Monitort Speaker', 'Kamera', 'Microphone'
        ];

        // Gabungkan kedua daftar
        $allNames = array_merge($musicalInstruments, $electronicDevices);

        // Pilih nama alat musik atau alat elektronik secara acak
        $instrumentName = $this->faker->randomElement($allNames);

        // Format harga dalam Rupiah
        $price = $this->faker->numberBetween(100000, 1000000);

        // Generate rating antara 1.0 hingga 5.0
        $rating = $this->faker->randomFloat(1, 1, 5);

        return [
            'name' => $instrumentName,
            'description' => $this->faker->sentence,
            'price' => $price,
            'stock' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl,
            'rating' => $rating,
        ];
    }
}
