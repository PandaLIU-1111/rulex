<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property int $rule_id 规则ID
 * @property string $when 匹配规则
 * @property string $then 规则内容
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class RuleContent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rule_contents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'rule_id', 'when', 'then', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'rule_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}