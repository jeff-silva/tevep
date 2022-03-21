<?php

namespace App\Models;

class FailedJobs extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'failed_jobs';
	protected $fillable = ['id', 'uuid', 'connection', 'queue', 'payload', 'exception', 'failed_at'];
}
