<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\MessageTo;
use App\Models\MessageKategori;

class massage extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = MessageKategori::firstOrCreate([
            'no_mk' => '1',
        ], [
            'description' => 'sent',
            'create_by' => 'Admin',
        ]);
        $kategori = MessageKategori::firstOrCreate([
            'no_mk' => '3',
        ], [
            'description' => 'draft',
            'create_by' => 'Admin',
        ]);
        $kategori = MessageKategori::firstOrCreate([
            'no_mk' => '3',
        ], [
            'description' => 'deleted',
            'create_by' => 'Admin',
        ]);
        $message = Message::create([
            'sender' => 1,
            'subject' => 'Test Email Subject',
            'message_text' => 'This is a test message for your inbox.',
            'message_status' => 'sent',
            'no_mk' => '1',
            'create_by' => 'Admin',
        ]);
        MessageTo::create([
            'message_id' => $message->message_id,
            'to' => 2,
            'create_by' => 'Admin',
        ]);
    }
}
