<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'departments';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $primaryKey = 'dept_no';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'char';

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'emp_no', 'emp_no');
    }

}
