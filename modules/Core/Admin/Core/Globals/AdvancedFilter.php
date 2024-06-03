<?php

namespace Modules\Core\Admin\Core\Globals;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Modules\Tour\Models\Tour;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\On;
use Livewire\Attributes\Modelable;

class AdvancedFilter extends Component
{
    #[Modelable]
    public $advanced;
    public $is_featured;
    public $vendor_id;
    public $location_id;

    #[On('advanced-filter')]
    public function advancedFilter()
    {
        $this->advanced['is_featured'] = $this->is_featured;
        $this->advanced['vendor_id'] = $this->vendor_id;
        $this->advanced['location_id'] = $this->location_id;
        $this->dispatch('handle-advanced-filter');
    }

    public function render()
    {
        return view('Core::admin.globals.advanced-filter');
    }

}
