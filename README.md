# Laravel 11 és Eloquent ORM Dokumentáció

## Laravel 11

**Laravel** egy PHP keretrendszer, amely az MVC (Model-View-Controller) architektúrát követi, és célja a webalkalmazások
fejlesztésének megkönnyítése.

### Főbb jellemzők:

- **MVC architektúra:** Elkülöníti az üzleti logikát, a megjelenítést és az adatkezelést.
- **Blade sablonrendszer:** Rugalmas templating motor.
- **Eloquent ORM:** Hatékony adatbáziskezelő réteg.
- **Routing:** Intuitív útvonalkezelő rendszer.
- **Middleware:** Köztes rétegek HTTP kérés és válasz kezeléséhez.
- **Migration és Seeding:** Adatbázis-szerkezetek és kezdeti adatok kezelése.
- **Artisan CLI:** Automatizált fejlesztői feladatok.

### Függőségek:

- **PHP 8.0+**
- **Composer**
- **Database Driver (pl. MySQL, PostgreSQL)**
- **Node.js és NPM**

## Eloquent ORM

**Eloquent** az alapértelmezett ORM a Laravel keretrendszerben.

### Főbb jellemzők:

- **Active Record minta:** Az adatbázis táblák és rekordok PHP osztályokként kezelhetők.
- **Könnyű kapcsolatok kezelése:** Egyszerű szintaxis a kapcsolatok kezeléséhez.
- **Query Builder:** Láncolható metódusokkal rendelkező lekérdező rendszer.
- **Attribute Casting:** Automatikus típuskonverzió az adatbázis mezők és a PHP tulajdonságok között.

### Függőségek:

- **illuminate/database**
- **illuminate/events**
- **illuminate/support**
