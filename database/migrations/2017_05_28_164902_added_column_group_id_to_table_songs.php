<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedColumnGroupIdToTableSongs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table = 'songs';
    protected $foreignTable = 'groups';
    protected $column = 'group_id';
    protected $columnIndex = 'songs_group_id_index';

    public function up()
    {

        Schema::table($this->table, function (Blueprint $table) {
            
            $table->integer($this->column)->unsigned()->nullable();
            $table->index($this->column, $this->columnIndex);
            $table->foreign($this->column)
                ->references('id')->on($this->foreignTable)
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropForeign([$this->column]);
            $table->dropIndex($this->columnIndex);
            $table->dropColumn($this->column);
        });
    }
}
