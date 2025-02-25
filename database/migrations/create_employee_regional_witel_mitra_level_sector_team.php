<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_employee', function (Blueprint $table) {
            $table->id();
            $table->integer('regional_id')->default(0);
            $table->integer('witel_id')->default(0);
            $table->integer('mitra_id')->default(0);
            $table->integer('level_id')->default(0);
            $table->integer('nik')->default(0);
            $table->string('full_name', 50)->nullable();
            $table->string('chat_id', 50)->nullable();
            $table->bigInteger('number_phone')->nullable();
            $table->text('home_address')->nullable();
            $table->enum('gender', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth', 50)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('ip_address', 50)->nullable();
            $table->dateTime('login_at')->nullable();
            $table->integer('is_active')->nullable()->comment('0 : deactive, 1 : active');
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->integer('updated_by')->nullable();

            $table->index('regional_id');
            $table->index('witel_id');
            $table->index('mitra_id');
            $table->index('level_id');
            $table->index('nik');
            $table->index('created_by');
            $table->index('updated_by');
        });

        Schema::create('tb_regional', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('alias', 50)->nullable();
        });

        Schema::create('tb_witel', function (Blueprint $table) {
            $table->id();
            $table->integer('regional_id')->default(0);
            $table->string('name', 50)->nullable();
            $table->string('alias', 50)->nullable();
            $table->index('regional_id');
        });

        Schema::create('tb_mitra', function (Blueprint $table) {
            $table->id();
            $table->integer('witel_id')->default(0);
            $table->string('name', 50)->nullable();
            $table->index('witel_id');
        });

        Schema::create('tb_level', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
        });

        Schema::create('tb_sector', function (Blueprint $table) {
            $table->id();
            $table->integer('mitra_id')->default(0);
            $table->string('chat_id', 50)->nullable();
            $table->string('name', 50)->nullable();
            $table->integer('team_leader1')->default(0);
            $table->integer('team_leader2')->default(0);
            $table->integer('team_leader3')->default(0);
            $table->integer('is_active')->default(0)->comment('0 : deactive, 1 : active');
            $table->integer('created_by')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->integer('updated_by')->default(0);
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index('mitra_id');
            $table->index('team_leader1');
            $table->index('team_leader2');
            $table->index('team_leader3');
            $table->index('created_by');
            $table->index('updated_by');
        });

        Schema::create('tb_team', function (Blueprint $table) {
            $table->id();
            $table->integer('sector_id')->default(0);
            $table->string('name', 100)->nullable();
            $table->integer('technician1')->default(0);
            $table->integer('technician2')->default(0);
            $table->integer('is_active')->default(0)->comment('0 : deactive, 1 : active');
            $table->integer('created_by')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->integer('updated_by')->default(0);
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index('sector_id');
            $table->index('technician1');
            $table->index('technician2');
            $table->index('created_by');
            $table->index('updated_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_employee');
        Schema::dropIfExists('tb_regional');
        Schema::dropIfExists('tb_witel');
        Schema::dropIfExists('tb_mitra');
        Schema::dropIfExists('tb_level');
        Schema::dropIfExists('tb_sector');
        Schema::dropIfExists('tb_team');
    }
};
