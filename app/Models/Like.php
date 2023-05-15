<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'comment_id',
	];

	/**
	 * Get the user who made the like.
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Get the comment that the like belongs to.
	 */
	public function comment()
	{
		return $this->belongsTo(Comment::class);
	}
}