***Wichtig:*** *Dieses Projekt ist unfertig und verfügt über keine gescheite Dokumentation. Dieses Projekt ist unter der MIT Lizenz lizensiert. Falls du also mit diesem Projekt anfangen möchtest, steht es dir so gut wie frei zur Verfügung.*

<br>

Abizeitung-v1
=============

Das hier ist die erste Version der Abizeitungsapp. Die Abizeitungsapp soll für die Schulen und Abschlussklassen den Prozess der Informationssammlung für die Abizeitung vereinfachen und digitalisieren.

Die Abizeitungsapp soll folgenden **Funktionsumfang** bieten:

1. Beichten
2. Storys
3. Zitate
4. *Abstimmungen (unfertig)*
5. *Umfragen (unfertig)*
6. *Rankings (unfertig)*
7. *Steckbriefe (unfertig)*
8. *Crush Count (nur in der 1. version)*

## Besonderheiten an dieser Version

1. Das Design dieser Version ist am Design der [Apple Homepage](https://apple.com) orientiert.
2. Diese Version verfügt über ein Protokoll, das über eine Public-Key-Verschlüsselung verschlüsselt ist und nur über bestimmte Admin Konten mit der Private-Key-Datei verschlüsselt werden kann.
3. Passwort verifizierung erfolgt über Vergleichen von SHA512 Hashes aus Benutzername und Passwort in der Datenbank. Für jede Anfrage des benutzeres werden die Anmeldedaten erneut geschickt und mit der Kontoliste überprüft.

## Verbindung mit der Datenbank

Die Datenbank nennt sich `hgu-abi-25_abizeitungDB`. Passwort lautet `""` (leer) und der Benutzername der Datenbank lautet `root` (Aufgrund der Default-Einstellungen des [XAMPP Servers](https://www.apachefriends.org). Konfiguriert können diese Einstellungen in der `sql.php` Datei im `php` Verzeichnis.

Die Datenbank ist in dem Verzeichnis als `hgu-abi-25_abizeitungDB for GitHub.sql` zu finden.

## Eingeschränkte Funktionsfähigkeit

Diese Version ist noch nicht fertig und wird nicht mehr von mir fertig gestellt werden. Aufgrund von Datenschutz ist diese App noch eingeschränkter, da die Funktionierenden Tabellen gelöscht werden mussten aufgrund von noch eingetragener Daten verschiedener Schüler.

## Admin Anmeldedaten

Benutzername: `KlimkeTim` <br>
Passwort: `pTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa`

