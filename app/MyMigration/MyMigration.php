<?php
/**
 * Created by PhpStorm.
 * User: didenko
 * Date: 10.06.17
 * Time: 18:34
 */

namespace App\MyMigration;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

abstract class MyMigration extends Migration
{

    const FOREIGN_TABLE    = 'foreignTable';
    const FOREIGN_TABLE_ID = 'foreignTableID';
    const ON_DELETE        = 'onDelete';
    const ON_UPDATE        = 'onUpdate';
    
    public $tableName;

    /**
     * 
    $data = [
         // foreignColumn_1 = songs_id
            foreignColumn_1 => [
                'foreignTable'   => 'songs',
                'foreignTableID' => 'id',
                'onDelete'       => 'CASCADE',
                'onUpdate'       => 'CASCADE',
            ],
             ...
     // foreignColumn_N = styles_id
            foreignColumn_N => [
                'foreignTable'   => 'styles',
                'foreignTableID' => 'id',
                'onDelete'       => 'CASCADE',
                'onUpdate'       => 'CASCADE',
                ],
            
    ];

     * @return array $data;
     */
    abstract public function getDataForForeignKey();

    /**
     * create All Index
     * @param Blueprint $table
     */
    protected function createAllIndex(Blueprint $table)
    {
        foreach ($this->getDataForForeignKey() as $columnName => $value) {
            $table->index($columnName, $this->tableName . '_' . $value[self::FOREIGN_TABLE] . '_' . $columnName . '_index');
        }
    }

    /**
     * Create all foreign key
     * @param Blueprint $table
     */
    protected function createAllFK(Blueprint $table)
    {
        foreach ($this->getDataForForeignKey() as $columnName => $value) {

            $table->foreign($columnName)
                ->references($value[self::FOREIGN_TABLE_ID])->on($value[self::FOREIGN_TABLE])
                ->onDelete($value[self::ON_DELETE])
                ->onUpdate($value[self::ON_UPDATE]);
        }

    }

    /**
     * Drop all foreign key
     * @param Blueprint $table
     */
    protected function dropAllFK(Blueprint $table)
    {
        foreach ($this->getDataForForeignKey() as $columnName => $value) {

            $table->dropForeign([$columnName]);
        }
    }

    /**
     * Drop all index
     * @param Blueprint $table
     */
    protected function dropAllIndex(Blueprint $table)
    {
        foreach ($this->getDataForForeignKey() as $columnName => $value) {

            $table->dropIndex($this->tableName . '_' . $value[self::FOREIGN_TABLE] . '_' . $columnName . '_index');
        }
    }
}