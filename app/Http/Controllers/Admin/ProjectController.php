<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.form', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request->all());

        // controllo se l'utente ha inserito o meno un'file image
        if (Arr::exists($data, 'image')) {

            // se il file c'è lo metto nello storage e lo assegno a una variabile che sarà il path da mettere nel db
            $path = Storage::put('uploads/project', $data['image']);
            // Log::debug($path); visibili in storage/logs/laravel.log
        }

        $project = new Project;
        $project->fill($data);

        // prima di salvare il project assegno a  $project->image il valore di $path per visualizzare l'immagine
        $project->image = $path;
        $project->save();
        return to_route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.form', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->validation($request->all(), $project->id);



        // controllo se l'utente ha inserito o meno un'file image
        if (Arr::exists($data, 'image')) {

            // se c'è già un immagina la elimino per poi sostituirla con quella nuova
            if ($project->image) Storage::delete($project->image);

            // se il file c'è lo metto nello storage e lo assegno a una variabile che sarà il path da mettere nel db
            $path = Storage::put('uploads/project', $data['image']);
            // $data['image'] = $path;
        }

        $project->fill($data);
        // prima di salvare il project assegno a  $project->image il valore di $path per visualizzare l'immagine
        $project->image = $path;
        $project->save();
        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // se c'è l'immagine, eliminala
        if ($project->image) Storage::delete($project->image);
        $project->delete();
        return to_route('admin.projects.index');
    }

    private function validation($data)
    {

        return Validator::make(
            $data,
            [
                'name' => 'required',
                'description' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'image' => 'nullable|image|mimes:jpg,jpeg,png',
                // valido anche il campo type_id collegato alla tabella types e va aggiunto nel fillable
                'type_id' => 'nullable|exists:types,id'
            ],
            [
                'name.required' => 'Il nome del progetto è obbligatorio',
                'description.required' => "La descrizione è obbligatoria",
                'start_date.required' => "Inserire la data di inizio progetto",
                'end_date.required' => "Inserire la data di fine progetto",
                'image.image' => "Il file inserito deve essere un'immagine",
                'image.mimes' => "Il file deve essere nei seguenti formati:jpg,jpeg,png",
                'type_id.exists' => "L' ID selezionato non esiste"

            ]
        )->validate();
    }
}
