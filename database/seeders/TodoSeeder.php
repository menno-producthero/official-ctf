<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    public function run(): void
    {
        $flag = "FLAG{whitespace_sql_injection_fun}";

        $hidden = $this->flagToWhitespace($flag);

        Todo::create([
            'title' => 'CTF Injection Puzzle',
            'description' => "hidden:" . $hidden,
        ]);
    }

    private function flagToWhitespace(string $flag): string
    {
        $binary = '';
        foreach (str_split($flag) as $char) {
            $binary .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
        }

        $whitespace = '';
        foreach (str_split($binary) as $bit) {
            $whitespace .= $bit === '0' ? ' ' : "\t";
        }

        return $whitespace;
    }
}
