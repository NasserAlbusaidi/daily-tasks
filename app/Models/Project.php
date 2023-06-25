<?php

namespace App\Models;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $table = 'projects';


    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'title',
        'estimation_cost',
        'engineer_owner',
        'project_owner',
        'actual_cost',
        'pdf_attachment',
        'excel_attachment',
        'status_id',
        'vote_number',
        'assigned_to',
    ];

    public function AssignedTo()
    {
        //many users

        return $this->belongsToMany(User::class);
    }

    public function projectOwner()
    {
        //one user
        return $this->belongsTo(User::class, 'project_owner');
    }

    public function engineerOwner()
    {
        //one user
        return $this->belongsTo(User::class, 'engineer_owner');
    }

    public function projectStatus()
    {
        //one status
        return $this->belongsTo(ProjectStatus::class, 'status_id');
    }

    public function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


}
