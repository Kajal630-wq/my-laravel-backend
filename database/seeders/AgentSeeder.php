<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        $agents = [
            [
                'name' => 'Sophia Martinez',
                'email' => 'sophia@estatehub.com',
                'phone' => '+1 (310) 555-0123',
                'role' => 'Luxury Specialist',
                'image' => 'https://randomuser.me/api/portraits/women/68.jpg',
                'experience_years' => 12,
                'properties_sold' => 45,
            ],
            [
                'name' => 'James Carter',
                'email' => 'james@estatehub.com',
                'phone' => '+1 (212) 555-0456',
                'role' => 'Investment Advisor',
                'image' => 'https://randomuser.me/api/portraits/men/32.jpg',
                'experience_years' => 8,
                'properties_sold' => 32,
            ],
            [
                'name' => 'Olivia Chen',
                'email' => 'olivia@estatehub.com',
                'phone' => '+1 (310) 555-0789',
                'role' => 'First Home Expert',
                'image' => 'https://randomuser.me/api/portraits/women/44.jpg',
                'experience_years' => 6,
                'properties_sold' => 28,
            ],
            [
                'name' => 'Michael Okonkwo',
                'email' => 'michael@estatehub.com',
                'phone' => '+1 (415) 555-0123',
                'role' => 'Commercial Realty',
                'image' => 'https://randomuser.me/api/portraits/men/75.jpg',
                'experience_years' => 10,
                'properties_sold' => 38,
            ],
        ];

        foreach ($agents as $agent) {
            Agent::create($agent);
        }
    }
}