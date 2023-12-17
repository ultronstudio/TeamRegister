# TeamRegister

[![wakatime](https://wakatime.com/badge/user/bf7a188a-bb73-4aa0-af09-654269bec427/project/018c6ead-fc4b-4240-91d0-2b566bdffa3f.svg)](https://github.com/ultronstudio/TeamRegister)

Stránka (šablona) pro registraci týmu do soutěží.

## Instalace na webový server

Pro instalaci stačí vložit tento projekt do adresáře na vašem serveru. Zkopírujte `.env.example` a přejmenujte ho na **.env**. V tomto souboru jsou všechny důležité údaje.

Po vytvoření proveďte instalaci knihoven pomocí `composer intsall` a proveďte migraci tabulek do databáze (kterou jste nastavili v .env souboru) pomocí příkazu `php artisan migrate`

## Dodatečné nastavení

### Patička

Pokud potřebujete, můžete upravit název vaší společnosti, který se zobrazuje v zápatí webu. To provedete tak, že v souboru .env přidáte hodnotu pro `SPOLECNOST`, tedy např.:

```cs
SPOLECNOST="NějakáSpolečnost s.r.o."
```

## Licence

Tento projekt je publikován pod [MIT licencí](http://opensource.org/licenses/MIT)

## Přispěvatelé

<!-- ALL-CONTRIBUTORS-LIST:START -->
<!-- prettier-ignore-start -->
<!-- markdownlint-disable -->

<!-- markdownlint-restore -->
<!-- prettier-ignore-end -->

<!-- ALL-CONTRIBUTORS-LIST:END -->
