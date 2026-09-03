<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;

class User extends Component
{
    public $title, $name, $last_name, $email, $telephone, $gdpr, $future_communications, $terms = 0, $zatvori = 0;
    public $modal_title = 'Your Contact Informations'; 

    protected $rules = [
        'name' => 'required|min:3',
        'last_name' => 'required|min:3',
        'title' => 'required',
        'email' => 'required|email',
        'telephone' => 'required|min:7',
        'gdpr' => 'required',
        'terms' => 'required',
    ];

    public function mount()
    {
        if (request()->session()->exists(env('INFO_KUKI'))){
            $this->modal_title = 'Change Your Contact Informations';
            $user_data = request()->session()->get(env('INFO_KUKI'));
            $this->name = $user_data['name'];
            $this->title = $user_data['title'];   
            $this->last_name = $user_data['last_name'];      
            $this->email = $user_data['email'];
            $this->telephone = $user_data['telephone'];
            $this->gdpr = $user_data['gdpr'];
            $this->future_communications = $user_data['futureCommunications'];
            $this->terms = $user_data['terms'];
        }
    }


    public function sejv(){

        $this->validate();

        $tmp = [
            'title' => $this->title,
            'name' => $this->name,   
            'last_name' => $this->last_name,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'gdpr' => $this->gdpr,
            'futureCommunications' => $this->future_communications,
            'terms' => $this->terms,
        ];

        request()->session()->put(env('INFO_KUKI'), $tmp);
        $this->emit('infoDodan');
       // $this->reset();
        $this->zatvori = true;
    }

    
    public function render()
    {
            
        return view('livewire.modals.user');
    }
}
