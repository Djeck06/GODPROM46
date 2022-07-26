<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use Livewire\WithFileUploads;
use App\Models\Transporter;
use Livewire\Component;
use Maatwebsite\Excel\Concerns\ToArray;

class CarrierParams extends Component
{
    use WithSorting, WithPerPagePagination, WithCachedRows , WithFileUploads;
    public $showEditModal = false;
  
    public $items = ['lex'=> null,
                        'kabis' => null,
                        'ursaf' => null,
                        'pdc'=> null,
                        'asm'=> null,
                        'asf'=> null,
                        'asv'=> null,
                        'cag'=> null,
                        'alctd'=> null,
                        'ati'=> null,] ;

    public $fileslongnames ; 
    public $initaction ;

    public $filters = [
        'search' => '',
    ];

    protected $queryString = ['sorts'];

    public Transporter $transporter;

    public function rules()
    {
        $rules = [
            'editing.firstname' => 'required',
            'editing.lastname' => 'required',
            'editing.phone' => 'required',
            'editing.description' => 'nullable',
            'editing.tva_number' => 'nullable',
            'editing.siren_number' => 'nullable',
            'editing.siret_number' => 'nullable',
            'editing.naf_code' => 'nullable',
            'editing.registration_number' => 'nullable',
           
        ];

        if($this->initaction == 'create' ){
            foreach($this->files as $k=>$v){
                $rules['files.'.$k] = 'required|file' ;
            }
        }

        if($this->initaction == 'edit' ){
            foreach($this->files as $k=>$v){
                $rules['files.'.$k] = 'nullable|file' ;
            }
        }

        return $rules ;
    }

    public function mount()
    {
        
        $this->initaction = Null;
        $this->editing = $this->makeBlankCarrier();
        $this->files = $this->items;
        $this->fileslongnames= ['lex'=> ['label'=>'Licence d exploitation'],
                        'kabis' => ['label'=> "KABIS"],
                        'ursaf' => ['label'=> "URSAF"],
                        'pdc'=> ['label'=> "Permis de Conduire"],
                        'asm'=> ['label'=> "Assurance marchandise"],
                        'asf'=> ['label'=> "Assurance Flotte"],
                        'asv'=> ['label'=> "Assurance véhicule"],
                        'cag'=> ['label'=> "Carte grise"],
                        'alctd'=> ['label'=> "Attestation LCTD"],
                        'ati'=> ['label'=> "Attestation d'impôts"],
                    ] ;

    }

 

    public function makeBlankCarrier()
    {
        return Transporter::make();
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankCarrier();
        $this->initaction = 'create' ;
        $this->showEditModal = true;
    }

    public function edit(Transporter $transporter)
    {
        $this->useCachedRows();
        if ($this->editing->isNot($transporter)) $this->editing = $transporter;

      
        $this->editing->medias->map(
            function ($item) {
                if( array_key_exists($item->document_type, $this->files)){
                    $this->fileslongnames[$item->document_type]['model'] = $item->toArray() ;
                    $this->fileslongnames[$item->document_type]['model']['fileUrl'] = $item->fileUrl() ;
                }
            }
        );

      
       
        $this->initaction = 'edit' ;
        $this->showEditModal = true;
    }

    public function getRowsQueryProperty()
    {
        $query = Transporter::query()
            ->when($this->filters['search'], fn ($query, $search) => $query->where('firstname', 'like', '%' . $search . '%')->orWhere('lastname', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%'));
        //dd($query->with('medias')->get()) ;
        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();
        $this->saveMedia();
        
        $this->initaction = Null ;
        $this->showEditModal = false;
    }

    private function saveMedia(){
        $medias = $this->editing->medias ;
        $medias_existant_keys =[];

        if(count($medias) > 0){
            $medias_existant_keys = $medias->map(function($item){
                return $item->document_type ;
            })->ToArray() ;
            $medias->map(function($item){
                if( array_key_exists($item->document_type, $this->files)){
                
                    if(!is_null($file = $this->files[$item->document_type] )){
                        
                        $item->name= $file->store('/transporters/', 'public') ;
                        $item->file_name= $file->getClientOriginalName();
                        $item->extension= $file->getClientOriginalExtension() ;
                        $item->mime_type= $file->getClientMimeType() ;
                        $item->size= $file->getSize()  ;
                        $item->order_column=
                        $item->save();

                    }
                
                }
            }) ;
        }

        

        $orther_files = $this->files ;
        foreach($medias_existant_keys as $v){
            unset($orther_files[$v]) ;
        }

        foreach($orther_files as $key =>$file){
            if(!is_null($file)){
                $media = new \App\Models\Media ;
                $media->model_id= $this->editing->id ;
                $media->model_type= $this->editing->getTable() ;
                $media->name=  $file->store('/transporters/', 'public') ;
                $media->file_name= $file->getClientOriginalName();
                $media->extension= $file->getClientOriginalExtension() ;

                $media->mime_type= $file->getClientMimeType() ;
                $media->size= $file->getSize() ;
                $media->document_type= $key ;
                $media->save();
            }
        }
    }

    public function render()
    {
      
        return view('livewire.admin.carriers', [
            'transporters' => $this->rows,
        ]);
    }
}
