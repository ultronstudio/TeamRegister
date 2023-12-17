<div class="card shadow-lg o-hidden border-0 my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center"><img src="https://placehold.co/500x150/000000/FFFFFF/png?text=LOGO"
                            width="250" height="75" style="margin: 0px;margin-bottom: 10px;">
                        <h4 class="text-dark mb-4" style="color: rgb(0,0,0);">Registrujte svůj tým!</h4>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="user" wire:submit="ulozit">
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input wire:model="nazev" class="form-control form-control-user" type="text"
                                    id="exampleFirstName-1" placeholder="Název týmu" name="nazev" title="Název týmu"
                                    @if (!empty($existingTeams)) list="tymy" @endif autocomplete="off">
                                @error('nazev')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if (!empty($existingTeams))
                                    <datalist id="tymy">
                                        @foreach ($existingTeams as $existingTeam)
                                            <option value="{{ $existingTeam }}"></option>
                                        @endforeach
                                    </datalist>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <input wire:model="pocet" wire:keydown="upravPocet"
                                    class="form-control form-control-user" type="number" id="exampleLastName-1"
                                    placeholder="Počet členů" name="pocet" title="Počet členů v týmu" min="1">
                                @error('pocet')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <label class="form-label" style="color: rgb(0,0,0);">Soutěžící</label>
                        @foreach ($soutezici as $klic => $hodnota)
                            <div class="row mb-3">
                                <div class="col">
                                    <input wire:model="soutezici.{{ $klic }}.jmeno"
                                        class="form-control form-control-user" type="text" id="clenJmeno"
                                        aria-describedby="clenJmeno" placeholder="Jméno" name="clenJmeno"
                                        title="Jméno soutěžícího" autocomplete="off">
                                    @error('soutezici.' . $klic . '.jmeno')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input wire:model="soutezici.{{ $klic }}.prijmeni"
                                        class="form-control form-control-user" type="text" id="clenPrijmeni"
                                        aria-describedby="clenPrijmeni" placeholder="Příjmení" name="clenPrijmeni"
                                        title="Příjmení soutěžícího" autocomplete="off">
                                    @error('soutezici.' . $klic . '.prijmeni')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input wire:model="soutezici.{{ $klic }}.datum"
                                        wire:change="priradKategorii($event.target.value, {{ $klic }})"
                                        class="form-control form-control-lg form-control-user" id="clenDatum"
                                        aria-describedby="clenDatum" placeholder="Příjmení" name="clenDatum"
                                        type="date" title="Datum narození soutěžícího"
                                        max="{{ now()->subYear(10)->format('Y-m-d') }}">
                                    @error('soutezici.' . $klic . '.datum')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input wire:model="soutezici.{{ $klic }}.kategorie"
                                        class="form-control form-control-user" type="text" id="clenKategorie"
                                        aria-describedby="clenKategorie" placeholder="Kategorie" name="clenKategorie"
                                        title="Kategorie soutěžícího podle věku" readonly>
                                    @error('soutezici.' . $klic . '.kategorie')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if (count($soutezici) > 1)
                                    <div class="col">
                                        <button wire:click="smazatSouteziciho({{ $klic }})"
                                            class="btn btn-danger d-block btn-user w-100 h-100" type="button">Odstranit
                                            soutěžícího</button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <div class="mb-3"></div>
                        <button class="btn btn-primary d-block btn-user w-100"
                            style="color: var(--bs-white);background: var(--bs-green);border-style: none;"
                            type="submit">Registrovat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
