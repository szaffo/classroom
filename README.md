# Classroom

A teaching system like google classroom

[Original description](http://webprogramozas.inf.elte.hu/#!/subjects/webprog-server/beadando/2019-20-2/lms)

## Getting started

To run the app, you need the following 4 command

```bash
composer install
php artisan migrate:fresh
php artisan db:seed --class=LmsSeeder
php artisan serve
```

## License

```
Szabó Martin
CQBO0I
Szerveroldali webprogramozás & Oktatási rendszer
Beküldés idejeOktatási rendszer
Ezt a megoldást Szabó Martin, Neptun ID küldte be és készítette a Szerveroldali webprogramozás kurzus Oktatási rendszer feladatához.
Kijelentem, hogy ez a megoldás a saját munkám.
Nem másoltam vagy használtam harmadik féltől származó megoldásokat.
Nem továbbítottam megoldást hallgatótársaimnak, és nem is tettem közzé.
Az Eötvös Loránd Tudományegyetem Hallgatói Követelményrendszere (ELTE szervezeti és működési szabályzata, II. Kötet, 74/C. §) kimondja, 
hogy mindaddig, amíg egy hallgató egy másik hallgató munkáját - vagy legalábbis annak jelentős részét - saját munkájaként mutatja be, 
az fegyelmi vétségnek számít. A fegyelmi vétség legsúlyosabb következménye a hallgató elbocsátása az egyetemről.
```

