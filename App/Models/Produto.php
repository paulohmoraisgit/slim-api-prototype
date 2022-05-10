<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Importante o nome da classe se o mesmo de uma tabela só que no singular. O Eloquent (ORM) dá um jeito no resto.
class Produto extends Model {
	protected $fillable = ['titulo', 'descricao', 'preco', 'fabricante', 'created_at', 'updated_at'];
}