<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'salaries';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $primaryKey = 'emp_no';

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'emp_no', 'emp_no');
    }
}
