<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;


trait StatusTrait
{
    public function changeStatus(String $status){
        $this->status()->create([
            'label' =>  $status,
            'source' => $this->getTable(),
        ]);
    }

    public function status()
    {
        return $this->hasMany('App\Models\Status', 'source_id', 'id')->where('source',$this->getTable());
    }
    
    public function lastStatus()
    {
        $r = $this->status();
        
        $r->getQuery()->orderBy('created_at','desc')->limit(1);
        $builder = $r->latest(); // Add your own conditions etc...

        $relation = new HasOne($builder->getQuery(), $this, 'source_id', 'id');
        return $relation;
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Model $model): void
        {
            $model->status()->create([
                'label' => 'pending',
                'source' => $model->getTable(),
            ]);
            
        });
    }

}
