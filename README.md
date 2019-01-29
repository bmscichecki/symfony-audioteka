# Audioteka
Jest to prosta aplikacja, w której użytkownik może tworzyć własną listę albumów muzycznych, które posiada.

Technologie wykorzystane w projekcie: PHP, framework Symfony 4, MySQL.
# Funkcjonalność administrator

## Dodawanie/usuwanie autorów i gatunków
Administrator ma możliwość dodania do bazy autorów i gatunków przez podanie ich nazwy
## Tworzenie/edycja/usuwanie albumów
Administrator ma możliwość dodania nowego albumu do bazy, w którym podaje tytuł danego albumu oraz autora 
i gatunek, które znajdują się w bazie 
# Funkcjonalność użytkownik
## Rejestracja
Użytkownik ma możliwość rejestracji do aplikacji poprzez podanie adresu e-mail oraz hasła
## Logowanie
Użytkownik loguje się do aplikacji przy użyciu adresu e-mail oraz hasła podanego przy rejestracji
## Tworzenie własnej listy albumów
Użytkownik może utworzyć własną listę albumów, jeśli znajdują się one w bazie. Może wówczas dodawać oraz usuwać posiadane przez siebie albumy.
# Wymagania
* PHP >= 7.1
* MySQL
# Instalacja
1. Sklonowanie repozytorium przez wydanie polecenia
```
$ git clone https://github.com/Metrowy/symfony-audioteka.git
```
2. Przejście do katalogu z projektem, skopiowanie pliku .env w celu połączenia z odpowiednią bazą danych
3. Instalacja zależności poprzez wydanie polecenia w katalogu z projektem:
```
$ composer install
```
4. Utworzenie schematu bazy danych
```
$ php bin/console doctrine:migrations:diff
```
5. Migracja bazy danych
```
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```
6. Uruchomienie serwera poprzez wydanie polecenia
```
php bin/console server:run
```
7. Aplikacja jest dostępna pod 127.0.0.1:8000. Dane do konta administratora
```
e-mail: admin@gmail.com
password: admin
```
# Zewnętrzne biblioteki
* [KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle)

# Jak używać?

## Rejestracja
Użytkownik aby dołączyć do audioteki powinien posiadać konto. Podaje on swój e-mail oraz hasło 
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/rejestracja.PNG)

## Logowanie
Użytkownik loguje się za pomocą adresu e-mail oraz hasła podanego w rejestracji 
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/logowanie.PNG)

## Dodanie gatunku 
Administrator ma możliwość dodania gatunku podając jego nazwę
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/gatunek.PNG)

Następnie zostanie on przekierowany do listy ze wszystkimi dodanymi gatunkami
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/listaGatunki.PNG)

## Dodanie autora
Administrator mamożliwość dodania autora podając jego nazwę
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/autor.PNG)

Następnie zostanie on przekierowany do listy ze wszystkimi dodanymi autorami 
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/listaAutorzy.PNG)

## Dodanie albumu
Administrator ma możliwość dodania nowego albumu podając jego tytuł, a następnie wybiera on autora oraz gatunek
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/album.PNG)

Następnie zostaje on przekierowany do listy wszystkich albumów
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/listaAlbumyAdmin.PNG)

Z poziomu listy albumów może on edytować dostępne albumy oraz je usuwać 

## Baza albumów 
Użytkownik ma możliwość przeglądania dostępnych albumów oraz dodania ich do swojej listy
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/listaAlbumyU%C5%BCytkownik.PNG)

Po kliknięciu w przycisk "Dodaj do mojej listy" album zostanie dodany do tabeli użytkownika, a sam użytkownik zostanie przeniesiony do listy albumów które posiada
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/listaU%C5%BCytkownika.PNG)

Z poziomu swojej listy może ją dowolnie edytować czyli usuwać posiadane albumy i dodawać nowe

## Zmiana hasła
Użytkownik ma możliwość zmiany hasła, które podał podczas zakładania konta 
![alt text](https://github.com/Metrowy/symfony-audioteka/blob/master/images/zmianaHasla.PNG)






