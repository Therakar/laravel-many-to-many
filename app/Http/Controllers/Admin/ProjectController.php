<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        //prendo tutti i dati
        $data = $request->validated();

        

        //creo l'oggetto model | posso copiare questa parte dal seeder
        $new_project = new Project();

        //compilo l'oggetto (o meglio le sue proprietà) | posso copiare questa parte dal seeder ma al posto di $comic metto $data 
        $new_project->fill($data); //mass assignment

        $new_project->slug= Str::slug($new_project->title);

        //upload immagini
        if(isset($data['cover_image'])) {
            //salvo il path dell'immagine a db
            $new_project->cover_image = Storage::disk('public')->put('uploads', $data['cover_image']);
        };
         
        //salvo (creo a db la riga)
        $new_project ->save(); //a questo punto l'autoincrement del db assegna l'id al nuovo elemento

        //dove reindirizzo l'utente una volta che crea l'elemento? --> 
        //magari all'index o allo show in modo che possa vedere l'elemento appena creato
         
        //redirect a show
        return redirect()->route('admin.projects.show', $new_project->slug)->with('message', 'Project created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project) //(string $slug)--> visto che sto usando lo slug non posso usare la dipendencies injection (Project $project), invece mi faccio passare la stringa $slug
    {
        // $project = Project::where('slug', $slug)->first(); //tramite il modello Project faccio una query "dove slug è uguale a $slug e seleziona il first (il primo record)"
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

        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //prendo i dati
        $data = $request->validated();

        $old_title = $project->title;

        $project->slug = Str::slug($data['title']);

        if ( isset($data['cover_image'])){
            if($project->cover_image) {
                //salvo il path dell'immagine a db
               Storage::disk('public')->delete($project->cover_image);
            }
            $data['cover_image'] = Storage::disk('public')->put('uploads', $data['cover_image']);
        }
        
        //faccio l'update con il mass assignment
        $project->update($data);
 
        //faccio un redirect a comics.show della risorsa aggiornata
        return redirect()->route('admin.projects.show', $project->slug)->with('message', "$old_title has been modified!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        if($project->cover_image){
            Storage::disk('public')->delete($project->cover_image);
        }

        ///cancello l'elemento
        $project->delete();

        //faccio un redirect a admin.projects.index
        return redirect()->route('admin.projects.index', $project->slug)->with('message', "$project->title has been deleted!");
    }
    
}
