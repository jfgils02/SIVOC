<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Project;
use App\Board;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$projects = Project::get();
        $customers = Customer::get();
        $users = User::get();

        $projects = DB::table('projects')
        ->join('customers', 'projects.client', '=', 'customers.id')
        ->select('projects.*', 'customers.name as name_customer')
        ->get();
        $colocado= Project::where("status","Colocado")->count();
        $proceso= Project::where("status","Proceso")->count();
        $terminado= Project::where("status","Terminado")->count();

        return view('projects.projects', compact('projects','customers', 'colocado', 'proceso', 'terminado', 'users'));
        

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $ano=date('y');
        $count="000";
        
        switch ($request->input('sltTypeProject')) {
            case 'PE':
                $projects = DB::table('projects')
                ->where('type', 'PE')
                ->orderBy('id')
                ->get();
                $count=$count+1+$projects->count();

                $name_project="PE-".$ano."-".$count;
                break;
            case 'PO':
                $projects = DB::table('projects')
                ->where('type', 'PO')
                ->orderBy('id')
                ->get();
                $count=$count+1+$projects->count();

                $name_project="PO-".$ano."-".$count;
                break;
            default:
                # code...
                break;
        }
        $project = new Project;
       
        $project->name = $request->input('inputProyecto');
        $project->type = $request->input('sltTypeProject');
        $project->client = $request->input('sltCliente');
        $project->name_project = $name_project;
        $project->status = $request->input('inputEstatus');
        
        $project->save();

        return redirect()->action([ProjectController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $users = Customer::get();

        $array=["project"=>$project, "users"=>$users];
        return response()->json($array);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        
        $project->update([
            'name' => $request->inputEditProyecto,
            'type' => $request->sltEditTypeProject,
            'client' => $request->sltEditCliente,
            'status' => $request->inputEditEstatus,
            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('projects');
    }

    public function createBoard(Request $request)
    {
        $board = new Board;
       
        $board->project_id = $request->input('inputIdProyect');
        $board->name = $request->input('inputNameBoard');
        
        
        $board->save();

        return redirect()->action([ProjectController::class, 'index']);
    }

    public function showBoards($id)
    {   
        $tableros = DB::table('boards')
        ->join('projects', 'boards.project_id', '=', 'projects.id')
        ->select('boards.*', 'projects.name as name_project')
        ->where('projects.id', $id)
        ->get();

        return response()->json(['data' => $tableros], Response::HTTP_OK);
    }
}
