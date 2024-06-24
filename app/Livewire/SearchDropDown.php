<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropDown extends Component
{
    public $search = '';
    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            $searchResults = Http::get('https://phimapi.com/v1/api/tim-kiem?keyword=' . $this->search)['data']['items'];
        }

        return view('livewire.search-drop-down', [
            "searchResults" => collect($searchResults)->take(7)
        ]);
    }
}
