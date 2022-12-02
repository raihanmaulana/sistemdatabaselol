<?php
    
namespace App\Http\Controllers;
    
use App\Models\Posisi;
use Illuminate\Http\Request;
    
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posisis = Posisi::latest()->paginate(5);
        return view('posisis.index',compact('posisis'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        ]);
    
        Posisi::create($request->all());
    
        return redirect()->route('posisis.index')
                        ->with('success','Posisi created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function show(Posisi $posisi)
    {
        return view('posisis.show',compact('posisi'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Posisi $posisi)
    {
        return view('posisis.edit',compact('posisi'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posisi $posisi)
    {
         request()->validate([
            'nama_posisi' => 'required',
            'id_posisi' => 'required',
        ]);
    
        $posisi->update($request->all());
    
        return redirect()->route('posisis.index')
                        ->with('success','Posisi updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posisi $posisi)
    {
        $posisi->delete();
    
        return redirect()->route('posisis.index')
                        ->with('success','Posisi deleted successfully');
    }
}


