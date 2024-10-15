<?php

namespace App\Helpers;

class TextHelpers {
    public static function splitText($text, $maxLength = 40) {
        $words = explode(' ', $text);
        $result = '';
        $line = '';

        foreach ($words as $word) {
            // Cek apakah menambahkan kata berikutnya melebihi panjang maksimum
            if (strlen($line . ' ' . $word) > $maxLength) {
                $result .= trim($line) . "<br/>"; // Tambahkan garis baru
                $line = $word; // Mulai baris baru dengan kata ini
            } else {
                $line .= ' ' . $word; // Tambahkan kata ke baris saat ini
            }
        }

        // Tambahkan baris terakhir jika ada
        if ($line) {
            $result .= trim($line);
        }

        return $result;
    }
}
