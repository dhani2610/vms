<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('region')->nullable();
            $table->string('entity_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('company_email')->nullable();
            $table->string('fax')->nullable();
            $table->text('domicile_address')->nullable();
            $table->text('operational_address')->nullable();
            $table->string('npwp_company')->nullable();
            $table->string('akta_pendiri_perusahaan')->nullable();
            $table->string('nib')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('pic_name')->nullable();
            $table->string('pic_position')->nullable();
            $table->string('pic_phone')->nullable();
            $table->string('pic_email')->nullable();
            $table->enum('status_verifikasi', ['approve', 'pending', 'not approve'])->default('pending');
            $table->string('type')->nullable();
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn([
                'region',
                'entity_type',
                'company_name',
                'office_phone',
                'company_email',
                'fax',
                'domicile_address',
                'operational_address',
                'npwp_company',
                'akta_pendiri_perusahaan',
                'nib',
                'postal_code',
                'pic_name',
                'pic_position',
                'pic_phone',
                'pic_email',
                'status_verifikasi',
                'type',
            ]);
        });
    }
};
