jadi saya menggunakan Laravel Backpacker, saya punya fitur user management yang dimana disini saya bisa CRUD user, namun ada kendala dimana ketika saya mengupdate maupun menambahkan datannya, password yang di input tidak ter hash pada database, yang seharusnya bentuknya misal seperti ini:



$2y$10$IVsivluo45ullEMxvE1Tnuf48AImLdNjHDnw9wPAgO0.... namun hasilnya malah berbentuk plaint text,

bisakah anda bantu saya memperbaiki atua mencarikan saya refereensi dokumentasi laravel backpacker?



ini controller saya:

<?php



namespace App\Http\Controllers\Admin;



use App\Http\Requests\UserRequest;

use Backpack\CRUD\app\Http\Controllers\CrudController;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;



/**

 * Class UserCrudController

 * @package App\Http\Controllers\Admin

 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud

 */

class UserCrudController extends CrudController

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

        CRUD::setModel(\App\Models\User::class);

        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');

        CRUD::setEntityNameStrings('user', 'users');

    }



    /**

     * Define what happens when the List operation is loaded.

     * 

     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries

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

        CRUD::setValidation(UserRequest::class);

        CRUD::setFromDb(); // set fields from db columns.



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



ini model saya:

<?php



namespace App\Models;



use Backpack\CRUD\app\Models\Traits\CrudTrait;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable

{

    use CrudTrait;

    use HasApiTokens, HasFactory, Notifiable;



    /**

     * The attributes that are mass assignable.

     *

     * @var array<int, string>

     */

    protected $fillable = [

        'name',

        'email',

        'password',

    ];



    /**

     * The attributes that should be hidden for serialization.

     *

     * @var array<int, string>

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];



    /**

     * The attributes that should be cast.

     *

     * @var array<string, string>

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];

}



nah saya punya informasi tambahan juga untuk kamu,

jadi saya tidak tau apakah ini file bawaan dari Laravel Backpacker, namun mungkin informasi ini dapat membantu anda untuk membantu saya:



PasswordController:

<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rules\Password;



class PasswordController extends Controller

{

    /**

     * Update the user's password.

     */

    public function update(Request $request): RedirectResponse

    {

        $validated = $request->validateWithBag('updatePassword', [

            'current_password' => ['required', 'current_password'],

            'password' => ['required', Password::defaults(), 'confirmed'],

        ]);



        $request->user()->update([

            'password' => Hash::make($validated['password']),

        ]);



        return back()->with('status', 'password-updated');

    }

}

