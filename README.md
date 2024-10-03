# Fuvarozási Cég Szimuláció és REST API

## Projekt célja

A projekt célja egy fuvarozással foglalkozó cég adatainak szimulálása, és ezek kezelésére épített REST API fejlesztése. A rendszer lehetővé teszi különböző felhasználók számára, hogy kezeljék a fuvarozási cég telephelyeit és járműveit.

## Route-ok

### Autentikáció
- **POST** `api/login`  
  Autentikáció végrehajtása. (Login)

### Telephelyek kezelése
- **GET** `api/user/{user}/site`  
  Listázza a felhasználó telephelyeit.  
  _Controller_: `api\SiteController@index`

- **POST** `api/user/{user}/site`  
  Új telephely hozzáadása.  
  _Controller_: `api\SiteController@store`

- **GET** `api/user/{user}/site/{site}`  
  Telephely részleteinek megtekintése.  
  _Controller_: `api\SiteController@show`

- **PUT/PATCH** `api/user/{user}/site/{site}`  
  Telephely adatainak frissítése.  
  _Controller_: `api\SiteController@update`

- **DELETE** `api/user/{user}/site/{site}`  
  Telephely törlése.  
  _Controller_: `api\SiteController@destroy`

### Járművek kezelése
- **GET** `api/user/{user}/sites/{site}/trucks`  
  Az adott telephely járműveinek listázása.  
  _Controller_: `api\TruckController@index`

- **GET** `api/user/{user}/sites/{site}/trucks/{truck}`  
  Egy konkrét jármű részleteinek megtekintése.  
  _Controller_: `api\TruckController@show`

## Telepítés lépései

Az alábbi lépések segítenek a projekt lokális telepítésében és futtatásában.

## Telepítés lépései

Az alábbi lépések segítenek a projekt lokális telepítésében és futtatásában.

### 1. Klónozd a repót
Nyisd meg a terminált, és futtasd az alábbi parancsot a projekt klónozásához:

    git clone https://github.com/felhasznalonev/repo-nev.git

### 2. Navigálj a projekt könyvtárba

    cd repo-nev

### 3. Telepítsd a függőségeket
Használj Composer-t és npm-et a PHP függőségek telepítéséhez:

    composer install
    npm install

### 4. Környezeti változók beállítása
Hozz létre egy `.env` fájlt, és másold bele a `.env.example` tartalmát:

    cp .env.example .env

Frissítsd a `.env` fájlban az adatbázis kapcsolatot és egyéb szükséges konfigurációkat.

### 5. Adatbázis migrációk futtatása
Futtasd a migrációkat az adatbázis struktúra létrehozásához:

    php artisan migrate

### 6. API kulcsok generálása
Generálj egy új alkalmazáskulcsot az `.env` fájlhoz:

    php artisan key:generate

### 7. Futtasd az alkalmazást
Indítsd el a lokális fejlesztői szervert:

    php artisan serve

Az alkalmazás mostantól elérhető lesz a [http://localhost:8000](http://localhost:8000) címen.

