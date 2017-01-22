<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    public function insertMsg($fid, $tid, $content)
    {
        $this->insert([
            'from_uid' => $fid,
            'to_uid' => $tid,
            'message' => $content,
            'mtype' => 1,
            'state' => 1,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }
}
