<h2>Innovation 3 : Suppression d'un centre</h2>
<p>
    Cette innovation permet de supprimer un centre si tous les vaccins du centre n'ont plus aucune doses (quantité = 0).<br>
    L'utilisateur choisit un centre à supprimer, nous allons grâce à des requêtes vérifier si tous les vaccins dans ce centre ont une quantité égale à 0, auquel cas nous pourrons supprimer le "centre_id" et tout ce qui est lié dans la table "stock" ainsi que le centre dans la table "centre".<br>
    Si jamais il y a des vaccins ayant une quantité non nulle, on les récupère et on les affiche pour l'utilisateur.<br>
    Nous avons décidé de faire cela comme 3ème innovation afin de permettre à l'utilisateur de supprimer un centre s'il a fait une erreur ou si ce n'est plus un centre de vaccination.
</p>
