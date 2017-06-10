<?php

use App\MyMigration\MyMigration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateJunctionTableForSongsAndStylesTables extends MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'songs_styles';
    public $songsId   = 'songs_id';
    public $stylesId  = 'styles_id';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {

            $table->integer($this->songsId)->unsigned();
            $table->integer($this->stylesId)->unsigned();
            $table->primary([$this->songsId, $this->stylesId]);

            //create all index
            $this->createAllIndex($table);

            //create all FK
            $this->createAllFK($table);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            // drop all FK
            $this->dropAllFK($table);
            //drop all Index
            $this->dropAllIndex($table);
        });
        Schema::drop($this->tableName);
    }

    /**
     * @return array
     */
    public function getDataForForeignKey()
    {
        $data = [
            $this->songsId => [
                self::FOREIGN_TABLE    => 'songs',
                self::FOREIGN_TABLE_ID => 'id',
                self::ON_DELETE        => 'CASCADE',
                self::ON_UPDATE        => 'CASCADE',
            ],
            $this->stylesId => [
                self::FOREIGN_TABLE    => 'styles',
                self::FOREIGN_TABLE_ID => 'id',
                self::ON_DELETE        => 'CASCADE',
                self::ON_UPDATE        => 'CASCADE',
            ],
        ];

        return $data;
    }

}
