<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateRuleContnetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rule_contents', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unique();
            $table->unsignedBigInteger('rule_id')->comment('规则ID')->index();
            $table->string('when')->comment('匹配规则');
            $table->text('then')->comment('规则内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_contents');
    }
}
