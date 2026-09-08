<?php

namespace Database\Seeders\School;

use Illuminate\Database\Seeder;
use App\Models\School\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'room_number' => '101',
                'floor' => '1',
                'building' => 'Building A',
                'description' => 'Room 101',
                'is_active' => true,
            ],
            [
                'room_number' => '102',
                'floor' => '1',
                'building' => 'Building A',
                'description' => 'Room 102',
                'is_active' => true,
            ],
            [
                'room_number' => '103',
                'floor' => '1',
                'building' => 'Building A',
                'description' => 'Room 103',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            Room::create($item);
        }
    }
}
