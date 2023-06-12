<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();

        if ($request->has('type_id') && !is_null($data['type_id'])) {
            $projects = Project::where('type_id', $data['type_id'])->paginate(15);
        } else {
            $projects = Project::paginate(15); //impagina 10 elementi per pagina 
        }

        $types = Type::all();
        return view('admin.projects.index', compact('projects', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // dd($request->all());
        // Creazione del progetto
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']); // questo associerà lo slug al titolo

        // Salvataggio del file
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('project_images', $request->image);
            $data['image'] = $path;
        }

        // Salvataggio del progetto nel DB
        $project = Project::create($data); // altro metodo al posto di fill e save, ciò richiede la variabile $fillable

        // Salvataggio dati nella tabella ponte
        if($request->has('technologies')) {
            $project->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.index')->with('message', "{$project->title} è stato aggiunto!");
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
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        // Aggionramento dei dati del progetto
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {

            // Se presente, cancella l'immagine precedente
            if($project->image) {
                Storage::delete($project->image);
            }

            $path = Storage::disk('public')->put('project_images', $request->image);
            $data['image'] = $path;
        }

        $project->update($data);

        // Aggiornamento del collegamento con le technologies
        if($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach(); // se i campi sono vuoti 
        }

        return redirect()->route('admin.projects.index')->with('message', "{$project->title} è stato modificato con successo!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach(); // anche se cascade è stato impostato, sempre meglio aggiungere il detach()

        if ($project->image) {
            Storage::delete($project->image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "{$project->title} è stato cancellato!");
    }
}
