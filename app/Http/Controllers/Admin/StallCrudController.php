<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StallRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Area;
/**
 * Class StallCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StallCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Stall::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/stall');
        CRUD::setEntityNameStrings('stall', 'stalls');
        CRUD::column('areaId')->type('select')->label('Area')
        ->entity('area')
        ->model('App\Models\Area')
        ->attribute('areaName');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StallRequest::class);
        CRUD::setFromDb(); // set fields from db columns.
        CRUD::field([
            'label'     => "Area",
            'type'      => 'select',
            'name'      => 'areaId', // the db column for the foreign key
            'entity'    => 'area', // the method that defines the relationship in your Model
            'model'     => "App\Models\Area", // related model
            'attribute' => 'areaName', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                return $query->orderBy('areaName', 'ASC')->get();
            }), 
        ]);
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
