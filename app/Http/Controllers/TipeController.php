<?php
    
namespace App\Http\Controllers;
    
use App\Models\Tipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TipeController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:tipe-list|tipe-create|tipe-edit|tipe-delete', ['only' => ['index','show']]);
         $this->middleware('permission:tipe-create', ['only' => ['create','store']]);
         $this->middleware('permission:tipe-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tipe-delete', ['only' => ['destroy']]);
    }

    public function getTipes(){
        $tipe = DB::table('tipes')->where('deleted_at', null)->get();
        return view('tipes.index')->with(['tipes'=>$tipe]);
    }

    public function index()
    {
        $keyword = Request()->keyword;
        // $tipes = Hero::where('nama_hero','LIKE','%'.$keyword.'%')->paginate(5);
        $tipes = DB::table('tipes')->where('nama_tipe', 'like', "%$keyword%")->get();
        return view('tipes.index')->with(['tipes' => $tipes]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipes.create');
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
            'id_tipe' => 'required',
            'nama_tipe' => 'required',
            'tipe_serangan' => 'required',
        ]);
    
        DB::insert('INSERT INTO tipes(id_tipe, nama_tipe, tipe_serangan) VALUES (:id_tipe, :nama_tipe, :tipe_serangan)',
        [
            'id_tipe' => $request->id_tipe,
            'nama_tipe' => $request->nama_tipe,
            'tipe_serangan' => $request->tipe_serangan,
        ]
        );
    
        return redirect()->route('tipes.index')
                        ->with('success','Berhasil Menambah Tipe!');
    }
    

    public function show($id)
    {
        $tipe_table = DB::table('tipes')->where('id_tipe', $id)->get()->first();
        return view('tipes.show')->with(['tipe'=>$tipe_table]);
    }
    
    
    public function edit($id)
    {
        $tipe = DB::table('tipes')->where('id_tipe', $id)->first();
        // return ($tipe);
        return view('tipes.edit')->with(['tipe'=>$tipe]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_tipe' => 'required',
            'nama_tipe' => 'required',
            'tipe_serangan' => 'required',
        ]);
        $data = [
            'id_tipe' => $request->id_tipe,
            'nama_tipe' => $request->nama_tipe,
            'tipe_serangan' => $request->tipe_serangan,
        ];
        // $tipe->update($request->all());
        DB::table('tipes')->where('id_tipe', $request->id_tipe)->update($data);
    
        return redirect()->route('tipes.index')
                        ->with('success','Berhasil Update Tipe!');
    }
    
    public function destroy($id)
    {
        $data=[
            'deleted_at' => Carbon::now(),
        ];
        DB::table('tipes')->where('id_tipe', $id)->update($data);
    
        return redirect()->route('tipes.index')
                        ->with('success','Berhasil Menghapus Tipe!');
    }
    public function deletelist()
    {
        $deleted_table = DB::table('tipes')->where('deleted_at','!=',null)->get();
        return view('tipes.trash')->with(['tipes'=>$deleted_table]);
        // return ($deleted_table);
    }
    public function restore($id)
    {
        DB::table('tipes')->where('id_tipe', $id)->update(["deleted_at" => null]);
        return redirect()->route('tipes.index')
                        ->with('success','Berhasil Restore Tipe!');
    }
    public function deleteforce($id)
    {
        DB::table('tipes')->where('id_tipe', $id)->delete();
        return redirect()->route('tipes.index')
                        ->with('success','Yah Tipenya dihapus permanen :(');
    }
}