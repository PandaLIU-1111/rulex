<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use Hyperf\Snowflake\Concern\Snowflake;

/**
 * @property int $id 
 * @property string $name 规则名称
 * @property string $code 规则code
 * @property string $when 匹配规则
 * @property string $then 规则内容
 * @property string $creator_id 创建人ID
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Rule extends Model
{
    use Snowflake;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rules';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'code', 'when', 'then', 'creator_id', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}