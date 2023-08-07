@php


    // {{-- Commande create Project Laravel : Composer create-project laravel/laravel:^10.0 Name-Project --}} \\
   //    {{-- comande for make controller : php artisan make:controller NameController --}}                    \\
  //     {{-- comande for make controller resource : php artisan make:controller -r NameController --}}         \\
 //      {{-- comande for make controller resource : php artisan make:controller -r NameController --}}          \\
//       {{-- comande for migrate to dataBase : php artisan migrate --}}                                          \\

// ------- ROUTING ( url ) ------------------------------------------------------------------------    
   
use Illuminate\Support\Facades\Route; // hn akat3ayt 3la libariry dyal Route
// tawjih url, kadir f lwal url wtani kadir l function lighadi taba9 mnin ikon dak lmasar fl url fhad l7ala kan9omo b tawjoh l page smitha 'Welcome' (dik l method 'get' kansta3mloha ila knta baghin n3ardo data)
Route::get('/greeting', function () {
    return 'Hello World';
});

// hnaya kansta3mlo l controller ya3ni mnin ikon dak l masar fl url, katmchi l controller wkatmchi l method fl controller smitha 'index'
use App\Http\Controllers\UserController; // hna kat3ayt 3la l controller
Route::get('/user', [UserController::class, 'index']);


// hna anwa3 les method likaynin
Route::get($uri, $callback); // 3ard data
Route::post($uri, $callback); // for save or khasn data
Route::put($uri, $callback); // for update
Route::patch($uri, $callback); // for update
Route::delete($uri, $callback); // for dalete
Route::options($uri, $callback); // option ya3ni kamlin 


// momkin n3tiw ldik Route ktar mn method fnafs lwa9t
Route::match(['get', 'post'], '/', function () {
    // ...
});


// hna kangol lih ay 7aja ya3ni les method kamlin, kansta3mloha f7alat kna m3arfinch ina method baghin nkhadmo (mn l2afdal anak t7adad)
Route::any('/', function () {
    // ...
});

// ya3ni utilisateur kitsana request iban fdak lmasar
use Illuminate\Http\Request;
Route::get('/users', function (Request $request) {
    // ...
});

// ya3ni momkin n7adad masar wn3tih l page lighadi imchi liha nichan mnin ikon dak lmasar
Route::view('/welcome', 'welcome');
// hna momkin nsifto data bhad tari9a lli lta7t, 'name' => 3ibara 3la variable fl page lighadi mchi liha
Route::view('/welcome', 'welcome', ['name' => 'Taylor']);

// n9dar ndir varibale fl url ya3ni kadir 9ima fl url lli t9dar t7tajha fdik l page lli ghadi tmchi liya
Route::get('/user/{id}', function (string $id) {
    return 'User '.$id;
});

// n9dar nsift var but kan3ti wa7d l9ima ftiradiya f7ala ila mkantch valeur fl url kat3ta dik lvaluer default
Route::get('/user/{name?}', function (string $name = null) {
    return $name;
});
 
Route::get('/user/{name?}', function (string $name = 'John') {
    return $name;
});

// hna ymkan nchrat regex 3ladik lvaluer lighadi tkoun fl url
Route::get('/user/{name}', function (string $name) {
    // ...
})->where('name', '[A-Za-z]+'); // bhad tari9a ((ila ga3ma 7tarmti dik regex katla9 {errer404}))
 
Route::get('/user/{id}', function (string $id) {
    // ...
})->where('id', '[0-9]+');
 
Route::get('/user/{id}/{name}', function (string $id, string $name) {
    // ...
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

// hna kinin regexs wajdin f des functions
Route::get('/user/{id}/{name}', function (string $id, string $name) {
    // ...
})->whereNumber('id')->whereAlpha('name');
 
Route::get('/user/{name}', function (string $name) {
    // ...
})->whereAlphaNumeric('name');
 
Route::get('/user/{id}', function (string $id) {
    // ...
})->whereUuid('id'); // !!!!
 
Route::get('/user/{id}', function (string $id) {
    //
})->whereUlid('id'); // !!!!
 
Route::get('/category/{category}', function (string $category) {
    // ...
})->whereIn('category', ['movie', 'song', 'painting']); // hna kangol lih mnin tkon category dimna dok les valuer lli fl array



// momkin n3ti route smiya n3ayat gha bsmiya 3and tari9a had l method, route('Smiya_Dyal_Route')
Route::get('/user/{id}/profile', function (string $id) {
    // ...
})->name('profile');

$url = route('profile', ['id' => 1]); // hnaya ila kan dak route ki7tage data kansiftha liha bdik tari9a 




Route::get('/user/{id}/profile', function (string $id) {
    // ...
})->name('profile');
 
$url = route('profile', ['id' => 1, 'photos' => 'yes']); // mnin nzid data wakha ga3ma mtloba 
 
// /user/1/profile?photos=yes # katban fl url bhad tari9a ka parametre


// hna kandir groupe dyal les routes, lli mkan3tich sala7iya dyal user ista3mlhoum 7ta yt7a9a9o chorot (['first', 'second']), exempele: tta dir login
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second middleware...
    });
 
    Route::get('/user/profile', function () {
        // Uses first & second middleware...
    });
});








// ------- VIEW ------------------------------------------------------------------------    
Route::get('/', function () { // kanmchi l page wkansift data
    return view('greeting', ['name' => 'James']);
});
return view('greeting') // tari9a khra bach nmchi lpage wnsift data
            ->with('name', 'Victoria')
            ->with('occupation', 'Astronaut');


use Illuminate\Support\Facades\View; // tari9a bach t3ayt 3la View facades
return View::make('greeting', ['name' => 'James']); // l7aja lli drna lfo9 gha hnaya sta3malna view Facades

return view('admin.profile', $data); // hnaya 3andi folder matalan smito admin kandkhol lih wkanchof l file smito profile, dik '.' n9dar n3awdha b '/' 

use Illuminate\Support\Facades\View;
return View::first(['custom.admin', 'admin'], $data); // hnaya kandir khtibar l page ila kant kandoz liya ila mkantch kanchof lakhra

use Illuminate\Support\Facades\View;
if (View::exists('emails.customer')) { // hna kangol lih ila l9a dik l page
    // tba9 hadchi lli hna
}


// ------- BLADE TEMPLATE (katsahal 3lina l coding fl pages view) ------------------------------------------------------------------------    
Hello, {!! $name !!}. // ila sift data fiha tage html dak tage kikhdam
Hello, {{$name}}. // hnaya katkhali klchi string ya3ni wkkha nsift tage html katkhalih kima houwa ga3ma katkhadmo
@endphp
@unless () {{-- hna kangol lih ila ga3ma t7a9a9 dak chart ya3ni kan dakchi false --}}
    {{-- taba9 hadchi lli hna --}}
@endunless
@auth {{-- ila kan dayr login --}}
{{-- taba9 hadchi --}}
@endauth
 
@guest {{-- ila mkanch dayr login --}}
    {{-- taba9 hadchi --}}
    @endguest

@php
    
// ------- Controller ( 3antari9o kandiro bzaf dyal l3amaliyat 9bal manwalo l l'page view ) ------------------------------------------------------------------------
// Commande create Controller : php artisan make:controller NameController
// ila bghit rbat routing bl controller awl 7aja khas n3araf Controller darkhl route
use App\Http\Controllers\HomeController; // ha bach kan3ayt 3la controller
Route::get('users/{id}', [HomeController::class, 'NameFunc']); // tari9a bach tkhadm l controller mnin ikon dak lmasar, khas l function lighadi n3ayat liha tkoun fl contorller
// Documontation fih dakchi advanced

// ------- Model( lmota7akim lmobachir b table mo3ayan f database ) ------------------------------------------------------------------------

// Model 3ndo 3ala9a bl Base De Donne, ya3ni ay 7aja tbghi taba9ha fl base de donne kadirha 3abra Model
// Migration wa7d l7aja likatkhalina nkhal9o les table fl date base 3an tari9 laravel bla mankatbo code sql
// comande bach tsayb migration : php artisan make:migration nameMigration
/*
comande for create model fnafs lwa9t create migration ldak lmodel 3la 2asas dik lmigration ghadi nsayb biha table wdik lmodel
ghadi tkhalini l3ab b data lli ftable lli saybt bl migration : php artisan make:model Student -m
*/
// ila nsit chi column : php artisan make:migration add_column_to_student --table=students

// anchar7o chwiya l class dyal migration
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // hdi function khasa for create table
    {
        Schema::create('book', function (Blueprint $table) { // l parametre lwal katkon fih smiya dyal table
            $table->id(); // hnaya kadi les Attrebuts
            
            $table->longText('description')->nullable()->default('text'); // type dyal l'attrebuts hiya smiya dyal function wl parametre hiya smiya dyal column
            $table->date('created_at')->nullable()->default(new DateTime()); // 3ad ymkan tzid l3ibat khrin
            $table->timestamps(); // hady katkoun flwal kat7adad lwa9t lli t7at bih dak l3nosor fl data base
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};



// ------- CRUD ------------------------------------------------------------------------
// create data base and create tables by this comande : php artisan make:model Name_Model -m
// -m hadi katsayb migration l table lli baghi tsayb fl data base m3ah lmodel lli ghadi t7akam 3an tari9o bdit table
// mn ba3d katsayb controller by this comande : php artisan make:controller NameController --resource --model=Product
// --resource kat3ni katsayb controller 3amr bdouk les function l2asasityin dyal CRUD
// --model=Product hadi kat3ni rbat liya dak l controller b model smito Product

// aji nchar7o controller resourse
class ComputresController extends Controller // Exempele
{
    public function index() // hdi function index katrad lik page ra2isiya m3a data ila knti m7tajha
    {
        return view("computers.index",[
            "computers" => Computer::all()
        ]);
    }
    
    public function create() // function create katrad l page dyal form lighadi n'creati 3an tari9a new object 
    {
        return view('computers.create');
    }
    
    public function store(Request $request) // function create kadir save f dataBase ldakchi lli 3mart fl form dyal create
    {
        $request -> validate([ // hdi function dyal validation
            "Name-Compt"   => ['required','Min:2','Max:50'], // l key howa name dyal input lli baghi nvalidi l value lli fiha, l value: hiya chorot lli bghit nt7a9a9 mnha link li fih anwa3 chorot laravel : https://laravel.com/docs/10.x/validation#rule-accepted
            "Origin-Compt" => 'required',
            "Price-Compt"  => ['required','numeric','regex:/^\d+(\.\d{1,2})?$/'],
            "image-Compt"  => ['required','image','mimes:jpg,jpeg,png,bmp,gif,svg,webp','max:2048'],
        ]);
        $image = $request->file('image-Compt')->store('ComputersImages','public'); // tari9a bach kadir save l file f fichier storage, wkib9a 3andk link dyal tswira
        $computer = new Computer(); // hna kangol lih ghadi creati object // wmanba3d kan3ti lkolla column valuer
        $computer->nameComputer = $request->input("Name-Compt"); // kadir lafectation les column fl base de donne
        $computer->originComputer = $request->input("Origin-Compt"); // katsta3mal method input kat3tiha name dyal input bach katakhod l value dyalo
        $computer->priceComputer = $request->input("Price-Compt");
        $computer->imageComputer = $image;
        $computer->save(); // hadi kadir save l data fl dataBase
        
        return redirect() -> route('computers.index'); // mn ba3d kanrja3 l'2i3adat tawjih 3an tari9 l'routage
    }

    public function show(Computer $computer) // hadi kadir l'affichage lwa7d lobject mo3ayan f page mo3ayana
    {
        return view('computers.show',[ // hna kanrad l page li baghi mchi liha m3a data dyal l'object
            'computer' => $computer
        ]);
    }
    
    public function edit(Computer $computer) // hadi kadir l page lighadi dir 3an tari9a l edit l object mo3ayan
    {
        return view('computers.edit',compact('computer')); // hna kanmchi ldik lpage wkansift m3ah lobject lighadi n'modifier
    }
    
    public function update(Request $request, Computer $computer) // hd l function katsta9bal request fih data kamla m3ah lobject lighadi ndir lih modification
    {   // hna kayna nafs traitment dyal store ghir hna mkandirch new object 7it ana ghadi nmodify object deja kayn machi ghadi ncreati new object
        $request -> validate([
            "Name-Compt"   => ['required','Min:2','Max:50'],
            "Origin-Compt" => 'required',
            "Price-Compt"  => ['required','numeric','regex:/^\d+(\.\d{1,2})?$/'],
            "image-Compt"  => ['required','image','mimes:jpg,jpeg,png,bmp,gif,svg,webp','max:10000'],
        ]);
        $image = $request->file('image-Compt')->store('ComputersImages','public');
        
        $computer -> nameComputer = strip_tags($request->input("Name-Compt"));
        $computer -> originComputer = strip_tags($request->input("Origin-Compt"));
        $computer -> priceComputer = strip_tags($request->input("Price-Compt"));
        $computer -> imageComputer = $image;
        $computer -> save();
        return redirect() -> route('computers.index')->with('variabe','value'); //hna kandir with bach nsift wa7d l variable
    } // $msg = Session::get('success'); ila t7a9a9 had chart ya3ni t7atat value fl variable success, so 7at dik l value f $msg

    public function destroy(Computer $computer) // traitment dyal hd l function sahla
    {
        Storage::delete($computer->imageComputer); // hdi ga3ma bghat tkhdam !!!!!!!!!!!!!
        $computer -> delete(); // katmchi l computer lighadi tm7i wkat3ayt 3la function smitha delete() wsafi l3onsor lli khtariti litm7a
        return redirect() -> route('computers.index',[
            'success' => 'Modify a été success'
        ]);
    }
}

// ------- Authentication Authorization| Login, Register and Middleware ------------------------------------------------------------------------
// Authentication : site dyalk tkon fih login w regestar 
// Authorization : ta7ad may9dar ywsal l7aja mo3ayana 7ta ykoun dayr login
// for install this : composer require laravel/ui, php artisan ui hna t9dar tsta3mal react wlla taillwend or bootstrap hna ghadi nsta3mlo l bootStrap
// php artisan ui bootstrap --auth
// npm install && npm run dev

// ------- Seeders and Factories (for insert data by laravel) ------------------------------------------------------------------------
// comande for create seeders : php artisan mike:seeder Name_seeder
// dawr dyal seeder howa labghiti t7at values by laravel for test matalan ola nta bghiti finta dir run l systeme t7at l value default f data base
// aji nchar7o class dyal seeder chwiya

class FirstAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() // hdi function run likatkhdam mnin kansta3mal comande : php artisan db:seed
    {
        User::create($this->DataFirstAdmin()); // hna 3ayat 3la l function lidart lta7t ya3ni kandir create l ligne jdida b data lli fl function lli lta7t
    }
    private function DataFirstAdmin(){ // hna create lwa7d l function katrad liya data li baghi ndirha hiya default, dartha private bach data matkonch bayna lkolchi
        return [ // khas data trja3 3la chkal array fih , "key" => "l'value"
            'name'=>'UserDefault',
            'email'=>'UserDefault123@gmail.com',
            'password'=>Hash::make('UserDefaultPass'),
        ];
    }
    User::factory()->count(15)->create([ // factory kat3tik function smitha count(10) kat3tiha l3adad dyal lignes lli baghi t7at fl database
            'name'=>'UserDefault',
            'email'=>'UserDefault123@gmail.com',
            'password'=>Hash::make('UserDefaultPass'),
        ];)
}

// mn ba3d makadir create l seeder katmchi l file DatabaseSeeder.php

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([FirstAdmin::class,ProductSeeder::class,OrderSeeder::class]); // hnaya kat3ayt 3la ga3 seeders lli bghititihom ikhadmmo mnin ndir l run l seeder bl comande : php artisan seed
    }
}

// hnaya momkin bnisba lseeders dir fihom ldakhl create l default data wlla tsta3n b factory lli kat3tik l2imkaniya dyal tsta3ma fakes data likatsayabhom laravel
// comande bach dir create l factory : php artisan make:factory Name !! name drori tkon nafs smiya dyal l model lighadi tkon mrbota bih ## momkin fl comande --modal=NameModaLlibaghiTrbatBih, wlkin nta aslan katsami l factory bsmiya dyal lmodel farah autoumatique laravel kifham wkirbat lik l factory lli saybti bl bdak lmmodel lli samiti bsmito

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Panier> // hnaya ra mktoba flkhar smiya dyal lmodel lli mrbota bih had l factory
 */
class PanierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // hnaya katktab l'key lli howa l name dyal lcolumn => l value lli baghi dir
            fake()->name(); // hnaya katwfar lik factory had l function lli dwina 3liha 9bila (b7al had l7ala sta3maltha bach nsatb fake name)
        ];
    }
}

