<?php

namespace App\Http\Livewire\Client\Account;

use App\Models\Client;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public User $user;
    public Client $client;
    public $upload;

    protected function rules()
    {
        return [
            'user.first_name' => 'required',
            'user.last_name' => 'required',
            'user.email' => 'required|email|unique:users,email,' . auth()->id(),
            'client.phone' => 'sometimes',
            'client.address' => 'sometimes',
            'client.country' => 'sometimes',
            'upload' => 'nullable|image|max:1000',
        ];
    }


    public function mount()
    {
        $this->user = auth()->user();
        $this->client = auth()->user()->client;
    }

    public function save()
    {
        $this->validate($this->rules());
        $this->user->save();
        $this->client->save();

        $this->upload && $this->user->update([
            'avatar' => $this->upload->store('/avatars/', 'public'),
        ]);

        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        // dd($this->client);
        return view('livewire.client.account.profile');
    }
}
