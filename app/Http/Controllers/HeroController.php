<?php
    
namespace App\Http\Controllers;
    
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class HeroController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:hero-list|hero-create|hero-edit|hero-delete', ['only' => ['index','show']]);
         $this->middleware('permission:hero-create', ['only' => ['create','store']]);
         $this->middleware('permission:hero-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:hero-delete', ['only' => ['destroy']]);
    }

    public function getHeroes(){
        $hero = DB::table('heroes')->where('deleted_at', null)->get();
        return view('heros.index')->with(['heros'=>$hero]);
    }

    public function index()
    {
        $keyword = Request()->keyword;
        // $heros = Hero::where('nama_hero','LIKE','%'.$keyword.'%')->paginate(5);
        $heroes = DB::table('heroes')->where('nama_hero', 'like', "%$keyword%")->get();
        return view('heros.index')->with(['heros' => $heroes]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('heros.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'id_hero' => 'required',
            'nama_hero' => 'required',
            'id_tipe' => 'required',
            'id_posisi' => 'required',
        ]);
    
        DB::insert('INSERT INTO heroes(id_hero, nama_hero, id_tipe, id_posisi) VALUES (:id_hero, :nama_hero, :id_tipe, :id_posisi)',
        [
            'id_hero' => $request->id_hero,
            'nama_hero' => $request->nama_hero,
            'id_tipe' => $request->id_tipe,
            'id_posisi' => $request->id_posisi,
        ]
        );
    
        return redirect()->route('heros.index')
                        ->with('success','Berhasil Menambah Hero!');
    }
    

    public function show($id)
    {
        $hero_table = DB::table('heroes')->where('id_hero', $id)->get()->first();
        return view('heros.show')->with(['hero'=>$hero_table]);
    }
    
    
    public function edit($id)
    {
        $hero = DB::table('heroes')->where('id_hero', $id)->first();
        // return ($hero);
        return view('heros.edit')->with(['hero'=>$hero]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_hero' => 'required',
            'nama_hero' => 'required',
            'id_tipe' => 'required',
            'id_posisi' => 'required'
        ]);
        $data = [
            'id_hero' => $request->id_hero,
            'nama_hero' => $request->nama_hero,
            'id_tipe' => $request->id_tipe,
            'id_posisi' => $request->id_posisi,
        ];
        // $hero->update($request->all());
        DB::table('heroes')->where('id_hero', $request->id_hero)->update($data);
    
        return redirect()->route('heros.index')
                        ->with('success','Berhasil Update Hero!');
    }
    
    public function destroy($id)
    {
        $data=[
            'deleted_at' => Carbon::now(),
        ];
        DB::table('heroes')->where('id_hero', $id)->update($data);
    
        return redirect()->route('heros.index')
                        ->with('success','Berhasil Menghapus Hero!');
    }
    public function deletelist()
    {
        $deleted_table = DB::table('heroes')->where('deleted_at','!=',null)->get();
        return view('heros.trash')->with(['heros'=>$deleted_table]);
        // return ($deleted_table);
    }
    public function restore($id)
    {
        DB::table('heroes')->where('id_hero', $id)->update(["deleted_at" => null]);
        return redirect()->route('heros.index')
                        ->with('success','Berhasil Restore Hero!');
    }
    public function deleteforce($id)
    {
        DB::table('heroes')->where('id_hero', $id)->delete();
        return redirect()->route('heros.index')
                        ->with('success','Yah, heronya dihapus permanen :(');
    }
}