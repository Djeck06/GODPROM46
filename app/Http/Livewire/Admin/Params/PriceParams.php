<?php

namespace App\Http\Livewire\Admin\Params;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Country;
use App\Models\Package;
use App\Models\Price;
use Livewire\Component;

class PriceParams extends Component
{
    use WithSorting, WithPerPagePagination, WithCachedRows;
    public $showEditModal = false;
    public $showGenerateModal = false;
    public $showFilters = false;

    public $defaultPrice = 0;
    public $defaultNotes = '';

    public $filters = [
        'search' => '',
        'package_id' => '',
        'pickup_country_id' => '',
        'delivery_country_id' => '',
    ];

    protected $queryString = ['sorts'];

    public Price $price;

    public function rules()
    {
        return [
            'editing.package_id' => 'required|exists:packages,id',
            'editing.pickup_country_id' => 'required|exists:countries,id',
            'editing.delivery_country_id' => 'required|exists:countries,id',
            'editing.price' => 'required|numeric',
            'editing.notes' => 'nullable',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankPrice();
    }

    public function makeBlankPrice()
    {
        return Price::make(['is_active' => false]);
    }

    public function showGenerateModal()
    {
        $this->defaultPrice = 0;
        $this->defaultNotes = '';
        $this->showGenerateModal = true;
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankPrice();

        $this->showEditModal = true;
    }

    public function edit(Price $price)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($price)) $this->editing = $price;

        $this->showEditModal = true;
    }

    public function getRowsQueryProperty()
    {
        $query = Price::query()
            ->when($this->filters['search'], fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'));

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function getPackagesProperty()
    {
        return Package::where('is_active', true)->get();
    }

    public function getPickupCountriesProperty()
    {
        return Country::where('is_pickup_country', true)->get();
    }

    public function getDeliveryCountriesProperty()
    {
        return Country::where('is_delivery_country', true)->get();
    }

    public function generatePrices()
    {
        $this->validate([
            'defaultPrice' => 'required|numeric',
            'defaultNotes' => 'nullable',
        ]);

        foreach ($this->packages as $package) {
            foreach ($this->pickupCountries as $pickupCountry) {
                foreach ($this->deliveryCountries as $deliveryCountry) {
                    if ($pickupCountry->id == $deliveryCountry->id) continue;

                    Price::firstOrCreate(
                        [
                            'package_id' => $package->id,
                            'pickup_country_id' => $pickupCountry->id,
                            'delivery_country_id' => $deliveryCountry->id,
                        ],
                        [

                            'price' => $this->defaultPrice,
                            'notes' => $this->defaultNotes,
                        ]
                    );
                }
            }
        }

        $this->showGenerateModal = false;

        //Notification
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function render()
    {
        return view('livewire.admin.params.prices', [
            'prices' => $this->rows,
            'packages' => $this->packages,
            'pickupCountries' => $this->pickupCountries,
            'deliveryCountries' => $this->deliveryCountries,
        ]);
    }
}
