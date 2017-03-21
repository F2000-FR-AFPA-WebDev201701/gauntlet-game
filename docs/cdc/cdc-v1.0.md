# Cahier des charges V1.0
07/03/2017 - 11H05

GAUNTLET

## Le JEU

### Fiche du jeu
- Hack&Slash en multiplayer coop�ratif (r�seau Internet).
- Vue de dessus.
- Son & Musique.

### But du jeu 
- Grimper en haut du donjon qui fait X maps afin de d�livrer la princesse.
- Chaque map est pr�difinie � l'avance.
- Chaque map poss�de une sortie pour monter au niveau au dessus.

### Ecran de la zone de jeu (gauche) : 
- Plateau fixe : 480 x 640 pixels.
- Damier : 15 cases x 20 cases.
- Case : 32 pixels par pixels.

### Colonne de droite : 
Noms des persos de la partie en cours (actif et non actifs)
Infos de la partie actuelle (en PO) :
- Nom du Perso.
- Type.
- Points de vie.
- Score (PO).

### R�gles de d�placements :
- D�placement X / Y.
- D�placement au clavier avec les fl�ches.
- Tir avec la barre espace.
- Tour � tour automatique limit� � XX secondes.
- Bords limit�s (cf �cran de la zone de jeu).

### Personnage :
- 1 type de personnage : war par exemple.
- 1 position initiale connue dans le donjon.
- Attaque au jet (jet dans la direction sp�cifi�e par l'orientation du player).
- XXX points de vie.
- Force d'attaque.

### Monstres :
- 1 type de monstre (fantomes).
- Ont une position initiale connue.
- Avancent vers le h�ro (CAC).
- XXX points de vie.
- Force d'attaque.
- Ajoutent XXX PO au personnage lors qu'ils sont tu�s. Si plusieurs joueurs XXX PO reparties sur l'ensemble des joueurs.

### Objets :
Utilis� lors que l'on passe dessus:
- Potions : + XX points de vie.
- Cl�s : On peut les cumuler (sert � ouvrir les portes).
- Coffres : + XX Pi�ces.

### D�cors :
- Portails de sortie (level sup�rieur).
- Murs.
- Portes.
- G�n�rateur de monstres.

## Fonctionnalit�s Avanc�es
### Suivant la classe du perso :
- Points de vie.
- Attaque (puissance).
- Port�e de l'attaque.

### Monstres :
- Plus de types de monstres avec caract�ristiques diff�rentes (pt de vie, attaque, port�e de l'attaque...).
- Emplacement al�atoire (mode de jeu = al�atoire).

### Maps :
- Maps plus nombreuses.
- Al�atoires possible (mode de jeu = al�atoire).
- G�n�rateur de monstres.

### Items :
- Objets suppl�mentaires : Armures, tr�sors, ...

## Limites du projet
- Multiplayer (local = 1 machine).

## Pages

### Page d'accueil
- Pas de header / pas de aside
- Zone de login sur la partie principale de l'�cran
- Logo en fond sur l'�cran de login
- En bas infos sur le jeu (r�gles, commandes, scores (ou page � part), copyright, ...).

### Page des games
- Pas de header
- Liste des games sur la partie principale de l'�cran
- Aside :  Infos sur le player (Statut de connexion � une game / infos games (nb joueur, nom de la game, ...)

### Page du jeu
- Pas de header
- Zone principale = zone de jeu
- Aside : 4 personnages (Nom, type, score, items, ...)
