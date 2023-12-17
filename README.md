# TeamRegister

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

# Licence

Tento projekt je licencován pod [MIT licencí](http://opensource.org/licenses/MIT)