<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'employees';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $primaryKey = 'emp_no';

    public function titles(){
        return $this->hasMany(Title::class, 'emp_no', 'emp_no');
    }
    public function salaries(){
        return $this->hasMany(Salary::class, 'emp_no', 'emp_no');
    }

    public function departments(){
        return $this->belongsToMany(Department::class);
    }

}
