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

### 1. Klónozd a repót
Nyisd meg a terminált, és futtasd az alábbi parancsot a projekt klónozásához:

```bash
git clone https://github.com/felhasznalonev/repo-nev.git
