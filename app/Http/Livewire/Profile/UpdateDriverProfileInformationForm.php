<?php

namespace App\Http\Livewire\Profile;

use App\Models\DriverProfile;
use App\Models\DriverProfile\AdditionalCarsCollection;
use App\Models\DriverProfile\AdditionalCarValue;
use App\Source\DriverProfile\Domain\SaveDriverProfile\SaveDriverProfileLogic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateDriverProfileInformationForm extends Component
{
    public string $carName;
    public string $carPlate;
    public bool $animals;
    public bool $smoking;
    public bool $hasPhoneNumber;
    public array $additionalCars;


    public function render()
    {
        return view('profile.update-driver-profile-information-form');
    }

    public function mount()
    {
        $this->animals = false;
        $this->smoking = false;
        $this->hasPhoneNumber = Auth::user()->hasPhoneNumber();
        $this->additionalCars = [];

        $profile = DriverProfile::where('user_id', Auth::id())->first();
        if ($profile !== null) {
            $this->animals = $profile->animalsAllowed();
            $this->smoking = $profile->smokingAllowed();
            $this->carPlate = $profile->getCarPlate();
            $this->carName = $profile->getCarName();
            $this->additionalCars = $profile->getAdditionalCars();
        }
    }

    public function updateDriverProfile(SaveDriverProfileLogic $saveDriverProfileLogic)
    {
        $this->validate($this->validationRules(), $this->validationMessages());

        $saveDriverProfileLogic->save(
            userId: Auth::id(),
            carName: $this->carName,
            carPlate: $this->carPlate,
            animals: $this->animals,
            smoking: $this->smoking,
            additionalCars: $this->getAdditionalCars()
        );

        $this->emit('saved');
    }

    private function validationMessages(): array
    {
        return [
            'required' => __('validation.required', ['attribute' => ''])
        ];
    }

    private function validationRules(): array
    {
        return [
            'carName' => [
                'required',
                'string',
                'max:20',
                Rule::requiredIf(!empty($this->additionalCars)),
            ],
            'carPlate' => 'required|string|max:10',
            'animals' => 'nullable|boolean',
            'smoking' => 'nullable|boolean',
            'additionalCars' => 'array|nullable',
            'additionalCars.*.carName' => 'string|max:20',
            'additionalCars.*.carPlate' => 'string|max:10',
        ];
    }

    private function getAdditionalCars(): AdditionalCarsCollection
    {
        return new AdditionalCarsCollection(
            ...array_map(
                static fn(array $car): AdditionalCarValue => new AdditionalCarValue(
                    $car['carName'] ?? '',
                    $car['carPlate'] ?? ''
                ),
                $this->additionalCars
            )
        );
    }
}
