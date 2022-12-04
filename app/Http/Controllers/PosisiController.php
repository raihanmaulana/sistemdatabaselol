<?php
    
namespace App\Http\Controllers;
    
use App\Models\posisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PosisiController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:posisi-list|posisi-create|posisi-edit|posisi-delete', ['only' => ['index','show']]);
         $this->middleware('permission:posisi-create', ['only' => ['create','store']]);
         $this->middleware('permission:posisi-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:posisi-delete', ['only' => ['destroy']]);
    }

    public function getPosisis(){
        $posisi = DB::table('posisis')->where('deleted_at', null)->get();
        return view('posisis.index')->with(['posisis'=>$posisi]);
    }

    public function index()
    {
        $keyword = Request()->keyword;
        // $posisis = posisi::where('nama_posisi','LIKE','%'.$keyword.'%')->paginate(5);
        $posisis = DB::table('posisis')->where('nama_posisi', 'like', "%$keyword%")->get();
        return view('posisis.index')->with(['posisis' => $posisis]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posisis.create');
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
            'id_posisi' => 'required',
            'nama_posisi' => 'required',
            'spell' => 'required',
        ]);
    
        DB::insert('INSERT INTO posisis(id_posisi, nama_posisi, spell) VALUES (:id_posisi, :nama_posisi, :spell)',
        [
            'id_posisi' => $request->id_posisi,
            'nama_posisi' => $request->nama_posisi,
            'spell' => $request->spell,
        ]
        );
    
        return redirect()->route('posisis.index')
                        ->with('success','Berhasil Menambah Posisi!');
    }
    

    public function show($id)
    {
        $posisi_table = DB::table('posisis')->where('id_posisi', $id)->get()->first();
        return view('posisis.show')->with(['posisi'=>$posisi_table]);
    }
    
    
    public function edit($id)
    {
        $posisi = DB::table('posisis')->where('id_posisi', $id)->first();
        // return ($posisi);
        return view('posisis.edit')->with(['posisi'=>$posisi]);
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
            'id_posisi' => 'required',
            'nama_posisi' => 'required',
            'spell' => 'required',
        ]);
        $data = [
            'id_posisi' => $request->id_posisi,
            'nama_posisi' => $request->nama_posisi,
            'spell' => $request->spell,
        ];
        // $posisi->update($request->all());
        DB::table('posisis')->where('id_posisi', $request->id_posisi)->update($data);
    
        return redirect()->route('posisis.index')
                        ->with('success','Berhasil Update Posisi!');
    }
    
    public function destroy($id)
    {
        $data=[
            'deleted_at' => Carbon::now(),
        ];
        DB::table('posisis')->where('id_posisi', $id)->update($data);
    
        return redirect()->route('posisis.index')
                        ->with('success','Berhasil Menghapus Posisi!');
    }
    public function deletelist()
    {
        $deleted_table = DB::table('posisis')->where('deleted_at','!=',null)->get();
        return view('posisis.trash')->with(['posisis'=>$deleted_table]);
        // return ($deleted_table);
    }
    public function restore($id)
    {
        DB::table('posisis')->where('id_posisi', $id)->update(["deleted_at" => null]);
        return redirect()->route('posisis.index')
                        ->with('success','Berhasil Restore Posisi!');
    }
    public function deleteforce($id)
    {
        DB::table('posisis')->where('id_posisi', $id)->delete();
        return redirect()->route('posisis.index')
                        ->with('success','Yah Posisinya dihapus permanen :(');
    }
}