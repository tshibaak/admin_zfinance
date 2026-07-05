# Documentation d'installation - Zfinance

Ce projet est une application PHP avec un systeme de routing. Sur Windows avec Laragon, il faut donc faire pointer le site vers le dossier `public`, pas vers la racine du projet.

## Prerequis Windows

- Windows 10 ou Windows 11
- Laragon installe
- PHP active dans Laragon
- MySQL active dans Laragon, sauf si vous utilisez SQLite
- Composer installe

## 1. Installer Composer sur Windows

1. Aller sur le site officiel de Composer : <https://getcomposer.org/download/>
2. Telecharger `Composer-Setup.exe`
3. Lancer l'installateur
4. Quand Composer demande le chemin de PHP, choisir le PHP de Laragon, par exemple :

```txt
C:\laragon\bin\php\php-8.x.x\php.exe
```

5. Terminer l'installation
6. Ouvrir un nouveau terminal Windows, puis verifier :

```bash
composer --version
```

Si la commande affiche une version de Composer, l'installation est correcte.

## 2. Placer le projet dans Laragon

Copier le dossier du projet dans le dossier `www` de Laragon :

```txt
C:\laragon\www\zfinance
```

Le fichier principal du site doit se trouver ici :

```txt
C:\laragon\www\zfinance\public\index.php
```

## 3. Installer les dependances PHP

Ouvrir le terminal Laragon :

1. Clic droit sur Laragon
2. `Terminal`
3. Aller dans le dossier du projet :

```bash
cd C:\laragon\www\zfinance
```

Installer les dependances :

```bash
composer install
```

Cette commande cree le dossier `vendor`. Le site ne peut pas fonctionner sans ce dossier, car `public/index.php` charge :

```php
vendor/autoload.php
```

Important : utilisez `composer install` simplement. Ne lancez pas `composer install --no-dev`, car le projet utilise actuellement `vlucas/phpdotenv` pour lire le fichier `.env`.

## 4. Creer le fichier `.env`

A la racine du projet, creer un fichier nomme `.env` :

```txt
C:\laragon\www\zfinance\.env
```

Contenu conseille pour Laragon avec MySQL :

```env
APP_URL=

DB_SGBD=mysql
DB_HOST=127.0.0.1:3306
DB_NAME=zfinance
DB_USER=root
DB_MDP=
```

Si votre MySQL Laragon utilise le port `3307`, mettez plutot :

```env
DB_HOST=127.0.0.1:3307
```

Si vous ne voulez pas configurer MySQL tout de suite, vous pouvez utiliser SQLite :

```env
APP_URL=

DB_SGBD=sqlite
DB_HOST=
DB_NAME=zfinance
DB_USER=root
DB_MDP=
```

## 5. Creer la base de donnees MySQL

Dans Laragon :

1. Demarrer `Apache` et `MySQL`
2. Cliquer sur `Database`
3. Ouvrir la console SQL ou HeidiSQL
4. Importer le fichier :

```txt
C:\laragon\www\zfinance\database\schema.sql
```

Ce fichier cree la base `zfinance`, les tables necessaires et un compte administrateur par defaut :

```txt
Utilisateur : admin
Mot de passe : admin123
```

## 6. Configurer Laragon pour acceder au site

Comme le projet utilise un router PHP, le point d'entree doit etre le dossier `public`.

### Option recommandee : virtual host Laragon

1. Dans Laragon, verifier que l'option `Auto virtual hosts` est active
2. Clic droit sur Laragon
3. `Preferences`
4. Verifier que le Document Root est bien :

```txt
C:\laragon\www
```

5. Creer un virtual host qui pointe vers :

```txt
C:\laragon\www\zfinance\public
```

6. Redemarrer Laragon
7. Acceder au site dans le navigateur :

```txt
http://zfinance.test
```

### Option simple : acces direct au dossier public

Si vous ne configurez pas de virtual host, vous pouvez essayer :

```txt
http://localhost/zfinance/public
```

Dans ce cas, si certaines routes ou certains liens ne fonctionnent pas correctement, utilisez plutot l'option recommandee avec le virtual host.

## 7. Pages utiles

Accueil :

```txt
http://zfinance.test/
```

Connexion admin :

```txt
http://zfinance.test/login
```

Tableau de bord admin :

```txt
http://zfinance.test/admin/dashboard
```

## 8. Probleme courant

### Erreur `vendor/autoload.php not found`

Les dependances ne sont pas installees. Lancez :

```bash
composer install
```

### Erreur avec le fichier `.env`

Verifiez que le fichier `.env` existe bien a la racine du projet :

```txt
C:\laragon\www\zfinance\.env
```

### Erreur de connexion MySQL

Verifiez :

- MySQL est demarre dans Laragon
- La base `zfinance` existe
- Le port MySQL est correct : souvent `3306`, parfois `3307`
- Les valeurs de `DB_USER` et `DB_MDP` correspondent a votre Laragon

Pour Laragon, les identifiants par defaut sont souvent :

```env
DB_USER=root
DB_MDP=
```

### Page 404 sur les routes comme `/login`

Le site est probablement ouvert depuis le mauvais dossier. Il faut que Laragon pointe vers :

```txt
C:\laragon\www\zfinance\public
```

et non vers :

```txt
C:\laragon\www\zfinance
```
