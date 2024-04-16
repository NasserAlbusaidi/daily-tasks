<?php

namespace App\Models;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Project extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    public $table = 'projects';

    protected $appends = [
        'pdf_attachment',
        'excel_attachment'
    ];
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

    ];







    public function projectStatus()
    {
        //one status
        return $this->belongsTo(ProjectStatus::class, 'status_id');
    }

    public function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function projectOwner()
    {
        //one user
        return $this->belongsTo(User::class, 'project_owner');
    }

    public function getPdfAttribute()
    {
       //multiple attachments
        return $this->getMedia('pdf_attachment')->last();
    }

    public function getExcelAttribute()
    {
        //multiple attachments
        return $this->getMedia('excel_attachment')->last();
    }

    public function RegisterMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    //get owner name

    public function getProjectOwnerNameAttribute()
    {
        return $this->projectOwner->name ?? '';
    }
    //get engineer name

    public function getEngineerOwnerNameAttribute()
    {
        return $this->engineerOwner->name ?? '';
    }

    public function projectUsers()
    {
        //multiple users
        return $this->belongsToMany(ProjectUser::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function engineer_name()
    {
        //user with role engineer
        return $this->belongsTo(User::class, 'engineer_owner');
    }

    public function owner_name()
    {
        //user with role owner
        return $this->belongsTo(User::class, 'project_owner');
    }

    public function assigned_tos()
{
    return $this->belongsToMany(User::class, 'project_user');
}



}
