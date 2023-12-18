<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Team;
use App\Models\Competitor;

class Registrace extends Component
{
    public $nazev;
    public $pocet;
    public $soutezici;

    public $krokAktualni = 1;
    public $krokyCelkem = 3;

    private $data = ['jmeno' => '', 'prijmeni' => '', 'datum' => '', 'kategorie' => ''];

    protected $rules = [
        'soutezici.*.jmeno' => 'required',
        'soutezici.*.prijmeni' => 'required',
        'soutezici.*.datum' => 'required',
        'soutezici.*.kategorie' => ''
    ];

    protected $rulesTeam = [
        'nazev' => 'required',
        'pocet' => 'required|min:1'
    ];

    protected $messagesTeam = [
        'nazev' => 'Název je povinný',
        'pocet' => 'Počet členů je povinný'
    ];

    protected $messages = [
        'soutezici.*.jmeno' => 'Jméno je povinné',
        'soutezici.*.prijmeni' => 'Příjmení je povinné',
        'soutezici.*.datum' => 'Datum narození je povinné',
        'soutezici.*.kategorie' => ''
    ];

    public function mount()
    {
        $this->pocet = 1;

        $this->fill([
            'soutezici' => collect([$this->data])
        ]);
    }

    public function render()
    {
        // Získání a seřazení existujících názvů týmů
        $existingTeams = Team::pluck('nazev')->sort()->toArray();

        return view('livewire.registrace', ['existingTeams' => $existingTeams]);
    }

    public function smazatSouteziciho($klic)
    {
        $this->soutezici->pull($klic);

        $this->pocet = $this->soutezici->count();
    }

    public function pridatSouteziciho()
    {
        $this->soutezici->push($this->data);
    }

    public function ulozit()
    {
        $this->validate();

        // Kontrola existence týmu se stejným názvem
        $existingTeam = Team::where('nazev', $this->nazev)->first();
        if ($existingTeam) {
            $this->addError('nazev', 'Tým se stejným názvem již existuje');
            return;
        }

        // Vytvoření týmu
        $team = Team::create([
            'nazev' => $this->nazev,
            'pocet' => $this->pocet
        ]);

        // Uložení soutěžících
        foreach ($this->soutezici as $competitorData) {
            $competitor = new Competitor($competitorData);
            $team->competitors()->save($competitor);
        }

        session()->flash('success', 'Tým byl úspěšně registrován');

        // Promazání formuláře
        $this->reset();

        $this->fill([
            'soutezici' => collect([$this->data])
        ]);
    }

    public function priradKategorii($datum, $index)
    {
        $today = now();
        $birthDate = \Carbon\Carbon::parse($datum);
        $age = $today->diffInYears($birthDate);

        $this->soutezici = $this->soutezici->map(function ($item, $currentIndex) use ($index, $age) {
            if ($currentIndex === $index) {
                // Aktualizujeme kategorii pouze pro aktuální index
                if ($age <= 12) {
                    $item['kategorie'] = 'Děti';
                } elseif ($age <= 18) {
                    $item['kategorie'] = 'Juniori';
                } else {
                    $item['kategorie'] = 'Dospělí';
                }
            }

            return $item;
        });
    }

    public function upravPocet()
    {
        while ($this->soutezici->count() < $this->pocet) {
            $this->pridatSouteziciho();
        }

        while ($this->soutezici->count() > $this->pocet) {
            $this->smazatSouteziciho($this->soutezici->count() - 1);
        }
    }

    public function dalsiKrok()
    {
        $this->kontrola();
        $this->krokAktualni++;
    }

    public function predchoziKrok()
    {
        $this->krokAktualni--;
    }

    private function kontrola()
    {
        if($this->krokAktualni == 1) {
            $this->kontrola_Tym();
        } elseif($this->krokAktualni == 2) {
            $this->kontrola_Soutezici();
        }
    }

    private function kontrola_Tym()
    {
        $this->validate($this->rulesTeam, $this->messagesTeam);
    }

    private function kontrola_Soutezici()
    {
        $this->validate($this->rules, $this->messages);
    }
}
