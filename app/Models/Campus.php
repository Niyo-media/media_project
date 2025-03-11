<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;
    protected $primaryKey = 'campus_id';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    
    protected $fillable = ['campus_id', 'campus_name'];


    public static function generateCampusId($name)
{
    // Convert name to uppercase and split into words
    $words = explode(' ', strtoupper($name));
    $abbrParts = [];

    foreach ($words as $word) {
        // Get first letter
        $firstLetter = $word[0];

        // Remove vowels from the rest of the word
        $remaining = preg_replace('/[AEIOU]/', '', substr($word, 1));

        // Append first letter + first two consonants (if available)
        $abbrParts[] = $firstLetter . substr($remaining, 0, 4);
    }

    // Join with dashes (e.g., RP-MSNZ)
    $abbr = implode('-', $abbrParts);

    // Ensure uniqueness
    $counter = 1;
    $originalId = $abbr;
    while (Campus::where('campus_id', $abbr)->exists()) {
        $abbr = $originalId . '-' . $counter;
        $counter++;
    }

    return $abbr;
}

}
