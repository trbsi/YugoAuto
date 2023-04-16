<?php

namespace App\Http\Livewire\Profile;

use App\Models\DriverProfile;
use App\Source\DriverProfile\Domain\SaveDriverProfile\SaveDriverProfileLogic;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateDriverProfileInformationForm extends Component
{
    public string $carName;
    public string $carPlate;
    public bool $animals;
    public bool $smoking;

    protected $rules = [
        'carName' => 'required|string|max:20',
        'carPlate' => 'required|string|max:20',
        'animals' => 'nullable|boolean',
        'smoking' => 'nullable|boolean',
    ];

    public function render()
    {
        return view('profile.update-driver-profile-information-form');
    }

    public function mount()
    {
        $this->animals = false;
        $this->smoking = false;

        $profile = DriverProfile::where('user_id', Auth::id())->first();
        if ($profile !== null) {
            $this->animals = $profile->animalsAllowed();
            $this->smoking = $profile->smokingAllowed();
            $this->carPlate = $profile->getCarPlate();
            $this->carName = $profile->getCarName();
        }
    }

    public function updateDriverProfile(SaveDriverProfileLogic $saveDriverProfileLogic)
    {
        $this->validate();

        $saveDriverProfileLogic->save(
            userId: Auth::id(),
            carName: $this->carName,
            carPlate: $this->carPlate,
            animals: $this->animals,
            smoking: $this->smoking
        );

        $this->emit('saved');
    }
}
