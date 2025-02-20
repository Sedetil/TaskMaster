<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;

    protected $table = 'todolists';

    protected $fillable = [
        'user_id',
        'title', // This corresponds to 'nama_tugas'
        'description',
        'priority',
        'status', // Change 'status_tugas' to 'status'
        'due_date',
        'image',
    ];    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
