<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Anime extends Model
{
    protected $fillable = [
		'name', 'genero', 'idade_indicativa','episodios'
    ];
}