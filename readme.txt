Arthemia-fr par Michael Huntalung
Traduction française et adaptation (c) 2009 Emmanuel NETTER pour cplusn.com
Version 0.6
Distribué sous licence GPL v3 (voir le fichier gpl-3.0.txt présent dans le 
répertoire d'installation du programme).


Instructions d’installation
Comme pour tous les thèmes Wordpress, l’installation est relativement simple : 
téléchargez le fichier zip dont le lien est disponible au bas de cette page, 
puis décompressez-le. Copiez ensuite le répertoire arthemia-fr dans le 
répertoire wp-content/themes sur votre serveur, en utilisant par exemple un 
client FTP. Connectez-vous à votre interface d’administration Wordpress, et 
dans la section Apparence, vous devriez voir apparaître le thème Arthemia-fr. 
Il vous suffit alors de le sélectionner pour l’activer sur votre site.

Outils complémentaires
Si vous souhaitez voir apparaître le nombre d’affichage de vos pages dans 
Arthemia-fr, il faut que vous l’extension WP-PostViews de Lester Chan. De la 
même façon, pour avoir un affichage plus sympathique de la pagination de votre 
blog, il faut installer WP-PageNavi du même auteur.

Configuration
Une fois le thème choisi, vous devez créer deux nouvelles catégories, A la une 
et A l’affiche (le nom importe peu) et en noter les identifiants (celui-ci 
apparait dans la barre d’URL à la suite du mot-clé CAT_ID). Le dernier article
de la catégorie A la une est affiché en haut à gauche de la page d’accueil de 
votre site ; les quatre derniers articles de la catégorie A l’affiche sont 
listés en haut à droite de la page d’accueil. Attention, les articles de ces
catégories n’apparaissent pas ailleurs sur la page d’accueil.

Cliquez ensuite dans la section Apparence sur l’item « Options Arthemia-fr » 
pour accéder aux options de paramétrage du thème. Celle-ci sont regroupées en 
trois sections, dont une description succinte est donnée ci-dessous :

    * Préférences générales
          o Feuille de style : choix de la couleur globale du thème
          o Image d’en-tête : saisissez l’URL de l’image que vous souhaitez 
          avoir en fond de votre en-tête.
          o Google analytics : si vous avez un compte Goggle Analytics, vous 
          pouvez saisir le code d’appel ici
    * Options d’affichage et de navigation
          o Catégorie à la une : tapez l’identifiant de la catégorie créée plus
          haut
          o Catégorie à l’affiche : tapez l’identifiant de la catégorie créée 
          plus haut
          o Catégories à exclure : identifiant des catégories à exclure de la 
          barre d’affichage des catégories (par exemple à la une et à l’affiche)
          o Pages à exclure : idem mais pour la navigations des pages
    * Liens commerciaux.
          o Le code Google Adsense si vous avez un compte Adsense.

Ecrire un article
Pour voir apparaître sur vos pages une image en regard de chaque article de la 
liste (ou à la une et à l’affiche), il faut ajouter dans chaque article un 
champ personnalisé appelé « Image », et qui contiendra l’emplacement de l’image
en partant de la racine de votre site. Par exemple, si vous utilisez une image
déposée par Wordpress, ce sera wp-content/uploads/2009/05/monimage.jpg.

Support
Le dépôt de code d’Arthemia-se trouve sur github.com/enetter/Arthemia-fr. Les 
incidents sont à remonter à github.com/enetter/Arthemia-fr/issues.