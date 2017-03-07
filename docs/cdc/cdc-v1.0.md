# Cahier des charges V1.0
06/03/2017 - 15H57

GAUNTLET

## Le JEU

### Fiche du jeu
- Hack&Slash en multiplayer coopératif (réseau Internet).
- Vue de dessus.
- Son & Musique.

### But du jeu 
- Grimper en haut du donjon qui fait X maps afin de délivrer la princesse.
- Chaque map est prédifinie à l'avance.
- Chaque map possède une sortie pour monter au niveau au dessus.

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

### Règles de déplacements :
- Déplacement X / Y.
- Déplacement au clavier avec les flèches.
- Tir avec la barre espace.
- Tour à tour automatique limité à XX secondes.
- Bords limités (cf écran de la zone de jeu).

### Personnage :
- 1 type de personnage : war par exemple.
- 1 position initiale connue dans le donjon.
- Attaque au jet (jet dans la direction spécifiée par l'orientation du player).
- XXX points de vie.
- Force d'attaque.

### Monstres :
- 1 type de monstre (fantomes).
- Ont une position initiale connue.
- Avancent vers le héro (CAC).
- XXX points de vie.
- Force d'attaque.
- Représentes XXX PO lors qu'ils sont tués.

### Objets :
Utilisé lors que l'on passe dessus:
- potions : + XX points de vie.
- clés : On peut les cumuler (sert à ouvrir les portes).
- coffres : + XX Pièces.

### Décors :
- Portails de sortie (level supérieur).
- Murs.
- Portes.
- Générateur de monstres.

## Fonctionnalités Avancées
### Suivant la classe du perso :
- Points de vie.
- Attaque (puissance).
- Portée de l'attaque.

### Monstres :
- Plus de types de monstres avec caractéristiques différentes (pt de vie, attaque, portée de l'attaque...).
- Emplacement aléatoire (mode de jeu = aléatoire).

### Maps :
- Maps plus nombreuses.
- Aléatoires possible (mode de jeu = aléatoire).
- Générateur de monstres.

### Items :
- Objets supplémentaires : Armures, trésors, ...

## Limites du projet
- Multiplayer (local = 1 machine).

## Pages

### Page d'accueil
- Zone de login sur la partie principale de l'écran
- Logo en fond sur l'écran de login
- En bas infos sur le jeu (règles, commandes, scores (ou page à part), copyright, ...).

### Page du jeu
- pas de header
- zone principale = zone de jeu
- aside : 4 personnages (Nom, type, score, items, ...)
