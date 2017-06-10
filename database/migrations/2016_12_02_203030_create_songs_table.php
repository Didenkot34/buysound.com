<?php

use App\MyMigration\MyMigration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateSongsTable extends MyMigration
{

    public $tableName = 'songs';
    protected $foreignTable = 'groups';
    protected $groupId = 'group_id';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->integer($this->groupId)->unsigned()->nullable();
            $table->string('name');
            $table->string('slug');
            $table->float('price', 10, 2);
            $table->float('sale', 6, 2);
            $table->string('description');
            $table->string('img', 25);
            $table->string('audio', 25);
            $table->tinyInteger('rating')->unsigned()->default(1);
            $table->boolean('active')->default(false);
            $table->timestamps();
            
            //create index
            $this->createAllIndex($table);
            //create FK
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
            $this->groupId => [
                self::FOREIGN_TABLE    => $this->foreignTable,
                self::FOREIGN_TABLE_ID => 'id',
                self::ON_DELETE        => 'set null',
                self::ON_UPDATE        => 'CASCADE',
            ],
        ];

        return $data;
    }
}
