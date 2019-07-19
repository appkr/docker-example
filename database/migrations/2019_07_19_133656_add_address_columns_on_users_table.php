<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressColumnsOnUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('addr_si_do')->nullable()->comment('시도');
            $table->string('addr_si_gun_gu')->nullable()->comment('시군구');
            $table->string('addr_dong_ri')->nullable()->comment('읍면동리');
            $table->boolean('addr_is_mountain')->default(false)->comment('산 여부 (0:대지, 1:산)');
            $table->string('addr_jibun_number')->nullable()->comment('지번');
            $table->string('addr_road_name')->nullable()->comment('도로명');
            $table->unsignedTinyInteger('addr_is_basement')->default(0)->comment('지하 여부 (0:지상, 1:지하, 2:공중)');
            $table->string('addr_building_number')->nullable()->comment('건물번호');
            $table->string('addr_detail')->nullable()->comment('상세주소 (건물명 등)');
            $table->string('addr_point_x')->nullable()->comment('경도');
            $table->string('addr_point_y')->nullable()->comment('위도');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'addr_si_do',
                'addr_si_gun_gu',
                'addr_dong_ri',
                'addr_is_mountain',
                'addr_jibun_number',
                'addr_road_name',
                'addr_is_basement',
                'addr_building_number',
                'addr_detail',
                'addr_point_x',
                'addr_point_y',
            ]);
        });
    }
}
